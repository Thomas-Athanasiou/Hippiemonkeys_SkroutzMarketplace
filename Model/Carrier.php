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

    use Hippiemonkeys\Shipping\Model\AbstractCarrier;
    use Magento\Backend\App\Area\FrontNameResolver;
    use Magento\Framework\App\Config\ScopeConfigInterface;
    use Magento\Framework\App\State;
    use Magento\Framework\Exception\LocalizedException;
    use Magento\Quote\Model\Quote\Address\RateRequest;
    use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
    use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
    use Magento\Shipping\Model\Rate\ResultFactory;
    use Psr\Log\LoggerInterface;

    class Method
    extends AbstractCarrier
    {
        const CODE = "hippiemonkeysskroutzmarketplace";


        protected $_isFixed = true;

        protected $rateResultFactory;
        protected $rateMethodFactory;
        protected $appState;

        /**
         * @param ScopeConfigInterface $scopeConfig
         * @param ErrorFactory $rateErrorFactory
         * @param LoggerInterface $logger
         * @param ResultFactory $rateResultFactory
         * @param MethodFactory $rateMethodFactory
         * @param State $appState
         * @param array $data
         */
        public function __construct(
            ScopeConfigInterface $scopeConfig,
            ErrorFactory         $rateErrorFactory,
            LoggerInterface      $logger,
            ResultFactory        $rateResultFactory,
            MethodFactory        $rateMethodFactory,
            State                $appState,
            array                $data = []
        )
        {
            $this->rateResultFactory = $rateResultFactory;
            $this->rateMethodFactory = $rateMethodFactory;
            $this->appState = $appState;
            parent::__construct(
                $scopeConfig,
                $rateErrorFactory,
                $logger,
                $data
            );
        }

        /**
         * @throws LocalizedException
         */
        public function collectRates(RateRequest $request)
        {
            $result = false;

            if ($this->getConfigFlag('active') && $this->isAdminArea())
            {
                $result = $this->rateResultFactory->create();

                $method = $this->rateMethodFactory->create();

                $method->setCarrier($this->_code);
                $method->setCarrierTitle($this->getConfigData('title'));

                $method->setMethod($this->_code);
                $method->setMethodTitle($this->getConfigData('name'));

                $method->setPrice(0.00);
                $method->setCost(0.00);

                $result->append($method);
            }

            return $result;
        }

        /**
         * @throws LocalizedException
         */
        private function isAdminArea(): bool
        {
            return $this->appState->getAreaCode() === FrontNameResolver::AREA_CODE;
        }

        public function getAllowedMethods(): array
        {
            return [$this->_code => $this->getConfigData('name')];
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
        public function isShippingLabelsAvailable()
        {
            return true;
        }

        /**
         * {@inheritdoc}
         */
        public function requestToShipment($rateRequest)
        {
            return new DataObject();
        }

        /**
         * {@inheritdoc}
         */
        public function returnOfShipment($rateRequest)
        {
            return new DataObject();
        }
    }
?>