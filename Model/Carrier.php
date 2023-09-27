<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\CatalogInventory\Api\StockRegistryInterface,
        Magento\Directory\Helper\Data as DirectoryData,
        Psr\Log\LoggerInterface,
        Magento\Framework\DataObject,
        Magento\Framework\DataObjectFactory,
        Magento\Framework\Exception\NoSuchEntityException,
        Magento\Framework\App\State,
        Magento\Backend\App\Area\FrontNameResolver,
        Magento\Framework\App\Config\ScopeConfigInterface,
        Magento\Framework\Exception\LocalizedException,
        Magento\Quote\Model\Quote\Address\RateRequest,
        Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory as RateErrorFactory,
        Magento\Quote\Model\Quote\Address\RateResult\MethodFactory as RateMethodFactory,
        Magento\Shipping\Model\Tracking\ResultFactory as TrackingResultFactory,
        Magento\Shipping\Model\Tracking\Result\ErrorFactory as TrackingErrorFactory,
        Magento\Shipping\Model\Tracking\Result\StatusFactory as TrackingStatusFactory,
        Magento\Shipping\Model\Rate\ResultFactory as RateResultFactory,
        Magento\Sales\Api\Data\OrderInterface as MagentoOrderInterface,
        Hippiemonkeys\Shipping\Model\AbstractCarrierOnline,
        Hippiemonkeys\SkroutzMarketplace\Api\CarrierInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface;


    class Carrier
    extends AbstractCarrierOnline
    implements CarrierInterface
    {
        protected const CODE = CarrierInterface::CARRIER_CODE;

        /**
         * @inheritdoc
         */
        protected $_isFixed = true;

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
         * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
         * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
         * @param \Magento\Framework\DataObjectFactory $dataOjectFactory
         * @param \Magento\Shipping\Model\Tracking\ResultFactory $trackingResultFactory
         * @param \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackingErrorFactory
         * @param \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackingStatusFactory
         * @param \Magento\Directory\Helper\Data $directoryData
         * @param \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
         * @param \Magento\Framework\App\State $appState
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         * @param array $data
         */

         public function __construct(
            ScopeConfigInterface $scopeConfig,
            RateErrorFactory $rateErrorFactory,
            LoggerInterface $logger,
            RateResultFactory $rateResultFactory,
            RateMethodFactory $rateMethodFactory,
            DataObjectFactory $dataObjectFactory,
            TrackingResultFactory $trackingResultFactory,
            TrackingErrorFactory $trackingErrorFactory,
            TrackingStatusFactory $trackingStatusFactory,
            DirectoryData $directoryData,
            StockRegistryInterface $stockRegistry,
            State $appState,
            OrderRepositoryInterface $orderRepository,
            array $data = []
        )
        {
            parent::__construct($scopeConfig, $rateErrorFactory, $logger, $rateResultFactory, $rateMethodFactory, $dataObjectFactory, $trackingResultFactory, $trackingErrorFactory, $trackingStatusFactory, $directoryData, $stockRegistry, $data);
            $this->appState = $appState;
            $this->orderRepository = $orderRepository;
        }

        /**
         * @inheritdoc
         */
        public function collectRates(RateRequest $request)
        {
            $result = false;
            $isAdminArea = false;

            try
            {
                $isAdminArea = $this->isAdminArea();
            }
            catch (LocalizedException $localizedException)
            {
                $this->getLogger()->error($localizedException->getMessage());
            }

            if ($this->getActive() && $isAdminArea)
            {
                $method = $this->getRateMethodFactory()->create();
                $method->setCarrier($this->getCarrierCode());
                $method->setCarrierTitle($this->getCarrierTitle());
                $method->setMethod($this->getMethodCode());
                $method->setMethodTitle($this->getMethodTitle());
                $method->setPrice(0.00);
                $method->setCost(0.00);

                $result = $this->getRateFactory()->create();
                $result->append($method);
            }

            return $result;
        }

        /**
         * @inheritdoc
         *
         * @throws \Magento\Framework\Exception\LocalizedException
         */
        private function isAdminArea(): bool
        {
            return $this->getAppState()->getAreaCode() === FrontNameResolver::AREA_CODE;
        }

        /**
         * @inheritdoc
         */
        public function getAllowedMethods(): array
        {
            return [$this->getCarrierCode() => $this->getMethodTitle()];
        }

        /**
         * @inheritdoc
         */
        public function isTrackingAvailable()
        {
            return false;
        }

        /**
         * @inheritdoc
         */
        public function processShipmentRequest(DataObject $rateRequest): DataObject
        {
            $result = $this->getDataObjectFactory()->create();

            try
            {
                $order = $this->getOrderByMagentoOrder($rateRequest->getOrderShipment()->getOrder());
                $trackingCodes = $order->getCourierTrackingCodes();
                $shippingLabelContent = $this->getSkroutzShippingLabelContentByOrder($order);
                if($shippingLabelContent === null && count($trackingCodes) > 0)
                {
                    $result->setTrackingNumber($trackingCodes[0]);
                    $result->setShippingLabelContent($shippingLabelContent);
                }
                else
                {
                    $result->setHasErrors(true);
                    $result->setErrors(__('This Order isn\'t ready for shipment yet or applicable.'));

                }
            }
            catch (NoSuchEntityException)
            {
                $result->setHasErrors(true);
                $result->setErrors(__('This Order isn\'t linked to any Magento Order.'));
            }

            return new DataObject();
        }


        /**
         * Gets Skroutz Shipping Label By Order
         *
         * @access protected
         * @final
         *
         * @return string
         */
        public final function getSkroutzShippingLabelContentByOrder(OrderInterface $order): string
        {
            $courierVoucher = $order->getCourierVoucher();
            $shippingLabel = null;
            if($courierVoucher !== null)
            {
                $shippingLabel = file_get_contents($courierVoucher, false, null, 0, null);
            }

            return $shippingLabel;
        }


        /**
         * Gets Order By Magento Order
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         *
         * @throws \Magento\Framework\Exception\NoSuchEntityException
         */
        public final function getOrderByMagentoOrder(MagentoOrderInterface $magentoOrder): OrderInterface
        {
            return $this->getOrderRepository()->getByMagentoOrder($magentoOrder);
        }

        /**
         * Gets Method Title
         *
         * @access protected
         * @final
         *
         * @return string
         */
        protected function getMethodTitle(): string
        {
            return $this->getData('method_title');
        }

        /**
         * Gets Method Code
         *
         * @access protected
         * @final
         *
         * @return string
         */
        protected final function getMethodCode(): string
        {
            return self::METHOD_CODE;
        }

        /**
         * App State property
         *
         * @access private
         *
         * @var \Magento\Framework\App\State $appState
         */
        private $appState;

        /**
         * Gets App State
         *
         * @access protected
         *
         * @return \Magento\Framework\App\State
         */
        protected final function getAppState(): State
        {
            return $this->appState;
        }

        /**
         * Order Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         */
        private $orderRepository;

        /**
         * Gets Order Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         */
        protected final function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->orderRepository;
        }
    }
?>