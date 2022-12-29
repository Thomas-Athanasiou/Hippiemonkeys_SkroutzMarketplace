<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Psr\Log\LoggerInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Magento\ConfigurableProduct\Api\LinkManagementInterface,
        Magento\Store\Model\StoreManagerInterface,
        Magento\Catalog\Api\ProductRepositoryInterface,
        Magento\Quote\Model\QuoteFactory,
        Magento\Quote\Model\QuoteManagement,
        Magento\Sales\Model\Service\OrderService,
        Magento\Sales\Api\OrderRepositoryInterface as MagentoOrderRepositoryInterface,
        Magento\Quote\Model\Quote\Address\RateFactory as QuoteRateFactory,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface,
        Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableType,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class OrderProcessorMagentoOrderSubmit
    extends OrderProcessorAbstract
    {
        protected const
            CONFIG_ACTIVE = 'active',
            CONFIG_ACTIVE_CREATE_ORDER = 'active_create_order',
            CONFIG_DEFAULT_ORDER_COUNTRY = 'default_order_country',
            CONFIG_DEFAULT_ORDER_EMAIL = 'default_order_email',
            CONFIG_DEFAULT_ORDER_TELEPHONE  = 'default_order_telephone',
            CONFIG_DEFAULT_ORDER_FAX = 'default_order_fax',
            CONFIG_NEW_ORDER_STORE_ID = 'new_order_store_id',
            CONFIG_NEW_ORDER_STATUS_CODE = 'new_order_status_code',

            FORMAT_STREET = '%s %u';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface $addressRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface $customerRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         * @param \Magento\Store\Model\StoreManagerInterface $storeManager
         * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
         * @param \Magento\Quote\Model\QuoteFactory $quoteFactory
         * @param \Magento\Quote\Model\QuoteManagement $quoteManagement
         * @param \Magento\Sales\Model\Service\OrderService $orderService
         * @param \Magento\Sales\Api\OrderRepositoryInterface $magentoOrderRepository
         * @param \Magento\Quote\Model\Quote\Address\RateFactory $quoteRateFactory
         * @param \Magento\ConfigurableProduct\Api\LinkManagementInterface $linkManagement
         * @param \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurableType
         */
        public function __construct(
            LoggerInterface $logger,
            ConfigInterface $config,
            AddressRepositoryInterface $addressRepository,
            CustomerRepositoryInterface $customerRepository,
            OrderRepositoryInterface $orderRepository,
            StoreManagerInterface $storeManager,
            ProductRepositoryInterface $productRepository,
            QuoteFactory $quoteFactory,
            QuoteManagement $quoteManagement,
            OrderService $orderService,
            MagentoOrderRepositoryInterface $magentoOrderRepository,
            QuoteRateFactory $quoteRateFactory,
            LinkManagementInterface $linkManagement,
            ConfigurableType $configurableType
        )
        {
            parent::__construct($logger, $config);
            $this->_addressRepository = $addressRepository;
            $this->_customerRepository = $customerRepository;
            $this->_addressRepository = $addressRepository;
            $this->_orderRepository = $orderRepository;
            $this->_storeManager = $storeManager;
            $this->_productRepository = $productRepository;
            $this->_quoteFactory = $quoteFactory;
            $this->_quoteManagement = $quoteManagement;
            $this->_orderService = $orderService;
            $this->_quoteRateFactory = $quoteRateFactory;
            $this->_magentoOrderRepository  = $magentoOrderRepository;
            $this->_linkManagement = $linkManagement;
            $this->_configurableType = $configurableType;
        }

        /**
         * @inheritdoc
         */
        protected function processOrderInternal(OrderInterface $order): void
        {
            $config             = $this->getConfig();
            $orderRepository    = $this->getOrderRepository();
            try
            {
                $persistedOrder = $orderRepository->getByCode( $order->getCode() );
                $order->setId( $persistedOrder->getId() );
                $order->setMagentoOrder( $persistedOrder->getMagentoOrder() );
            }
            catch(NoSuchEntityException)
            {
                /** Order doesnt exist in the first place */
            }

            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder === null)
            {
                $storeId = $config->getData(self::CONFIG_NEW_ORDER_STORE_ID);
                $store = $this->getStoreManager()->getStore( $storeId ? $storeId : null);
                $quote = $this->getQuoteFactory()->create();
                $quote->setStore($store);
                $quote->setCurrency();

                $productRepository = $this->getProductRepository();
                $linkManagement = $this->getLinkManagement();
                $configurableType = $this->getConfigurableType();
                foreach($order->getLineItems() as $lineItem)
                {
                    $product = $productRepository->getById($lineItem->getShopUid());
                    if($product->getTypeId() === ConfigurableType::TYPE_CODE)
                    {
                        foreach($linkManagement->getChildren($product->getSku()) as $childProduct)
                        {
                            foreach($configurableType->getConfigurableAttributes($product) as $superAttribute)
                            {
                                $attributeCode = $superAttribute->getProductAttribute()->getAttributeCode();
                                if($childProduct->getAttributeText($attributeCode) === $lineItem->getSize()->getShopValue())
                                {
                                    $product = $childProduct;
                                    $lineItem->setShopUid((int) $childProduct->getId());
                                }
                            }
                        }
                    }

                    $product->setPrice($lineItem->getUnitPrice());
                    $quote->addProduct($product, $lineItem->getQuantity());
                }

                $customer = $order->getCustomer();
                $customerAddress = $customer->getAddress();
                $quoteAddressData = [
                    'firstname' => $customer->getFirstName(),
                    'lastname' => $customer->getLastName(),
                    'street' => sprintf(self::FORMAT_STREET, $customerAddress->getStreetName(), $customerAddress->getStreetNumber()),
                    'city' => $customerAddress->getCity(),
                    'country_id' => $config->getData(self::CONFIG_DEFAULT_ORDER_COUNTRY),
                    'region' => $customerAddress->getRegion(),
                    'postcode' => $customerAddress->getZip(),
                    'telephone' => $config->getData(self::CONFIG_DEFAULT_ORDER_TELEPHONE),
                    'fax' => $config->getData(self::CONFIG_DEFAULT_ORDER_FAX),
                    'save_in_address_book' => 1
                ];

                $quote->setCustomerFirstname( $customer->getFirstName() );
                $quote->setCustomerLastname( $customer->getLastName() );
                $quote->setCustomerEmail( $config->getData(self::CONFIG_DEFAULT_ORDER_EMAIL) );
                $quote->setCustomerIsGuest(true);

                $quote->getBillingAddress()->addData($quoteAddressData);
                $quoteRate = $this->getQuoteRateFactory()->create();
                $quoteRate->setCode('freeshipping_freeshipping')->getPrice(0);
                $quoteShippingAddress = $quote->getShippingAddress();
                $quoteShippingAddress->addData($quoteAddressData);
                $quoteShippingAddress->setCollectShippingRates(true)->collectShippingRates()->setShippingMethod('freeshipping_freeshipping');
                $quoteShippingAddress->addShippingRate($quoteRate);

                $quote->setPaymentMethod('cashondelivery');
                $quote->save();
                $quote->getPayment()->importData(['method' => 'cashondelivery']);
                $quote->collectTotals()->save();

                $magentoOrder = $this->getQuoteManagement()->submit($quote);
                if($magentoOrder !== null)
                {
                    $order->setMagentoOrder($magentoOrder);
                    $magentoOrder->setStatus(
                        $config->getData(self::CONFIG_NEW_ORDER_STATUS_CODE)
                    );
                    $this->getMagentoOrderRepository()->save($magentoOrder);
                    $orderRepository->save($order);
                }
            }
        }

        /**
         * Address Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface
         */
        private $_addressRepository;

        /**
         * Gets Address Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface
         */
        protected function getAddressRepository() : AddressRepositoryInterface
        {
            return $this->_addressRepository;
        }

        /**
         * Customer Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface
         */
        private $_customerRepository;

        /**
         * Gets Customer Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface
         */
        protected function getCustomerRepository() : CustomerRepositoryInterface
        {
            return $this->_customerRepository;
        }

        /**
         * Magento Order Repository property
         *
         * @access private
         *
         * @var \Magento\Sales\Api\OrderRepositoryInterface
         */
        private $_magentoOrderRepository;

        /**
         * Gets Magento Order Repository
         *
         * @access protected
         *
         * @return \Magento\Sales\Api\OrderRepositoryInterface
         */
        protected function getMagentoOrderRepository() : MagentoOrderRepositoryInterface
        {
            return $this->_magentoOrderRepository;
        }

        /**
         * Order Repository Interface
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        private $_orderRepository;

        /**
         * Gets Order Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        protected function getOrderRepository() : OrderRepositoryInterface
        {
            return $this->_orderRepository;
        }

        /**
         * Store Manager property
         *
         * @access private
         *
         * @var \Magento\Store\Model\StoreManagerInterface
         */
        private $_storeManager;

        /**
         * Gets Store Manager
         *
         * @access protected
         *
         * @return \Magento\Store\Model\StoreManagerInterface
         */
        protected function getStoreManager() : StoreManagerInterface
        {
            return $this->_storeManager;
        }

        /**
         * Product Repository property
         *
         * @access private
         *
         * @var \Magento\Catalog\Api\ProductRepositoryInterface
         */
        private $_productRepository;

        /**
         * Gets Product Repository
         *
         * @access protected
         *
         * @return \Magento\Catalog\Api\ProductRepositoryInterface
         */
        protected function getProductRepository() : ProductRepositoryInterface
        {
            return $this->_productRepository;
        }

        /**
         * Quote Factory property
         *
         * @access private
         *
         * @var \Magento\Quote\Model\QuoteFactory
         */
        private $_quoteFactory;

        /**
         * Gets Quote Factory
         *
         * @access protected
         *
         * @return \Magento\Quote\Model\QuoteFactory
         */
        protected function getQuoteFactory() : QuoteFactory
        {
            return $this->_quoteFactory;
        }

        /**
         * Quote Management property
         *
         * @access private
         *
         * @var \Magento\Quote\Model\QuoteManagement
         */
        private $_quoteManagement;

        /**
         * Gets Quote Management
         *
         * @return \Magento\Quote\Model\QuoteManagement
         */
        protected function getQuoteManagement() : QuoteManagement
        {
            return $this->_quoteManagement;
        }

        /**
         * Quote Rate Factory property
         *
         * @access private
         *
         * @var \Magento\Quote\Model\Quote\Address\RateFactory
         */
        private $_quoteRateFactory;

        /**
         * Gets Quote Rate Factory
         *
         * @access protected
         *
         * @return \Magento\Quote\Model\Quote\Address\RateFactory
         */
        protected function getQuoteRateFactory() : QuoteRateFactory
        {
            return $this->_quoteRateFactory;
        }

        /**
         * Link Management property
         *
         * @access private
         *
         * @var \Magento\ConfigurableProduct\Api\LinkManagementInterface
         */
        private $_linkManagement;

        /**
         * Gets Link Management
         *
         * @access protected
         *
         * @return \Magento\ConfigurableProduct\Api\LinkManagementInterface
         */
        protected function getLinkManagement() : LinkManagementInterface
        {
            return $this->_linkManagement;
        }

        /**
         * Configurable Type property
         *
         * @access private
         *
         * @var \Magento\ConfigurableProduct\Model\Product\Type\Configurable
         */
        private $_configurableType;

        /**
         * Gets Configurable Type
         *
         * @access protected
         *
         * @return \Magento\ConfigurableProduct\Model\Product\Type\Configurable
         */
        protected function getConfigurableType() : ConfigurableType
        {
            return $this->_configurableType;
        }
    }
?>