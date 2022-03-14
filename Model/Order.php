<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Api\SearchCriteriaBuilderFactory,
        Magento\Framework\Registry,
        Magento\Framework\Data\Collection\AbstractDb,
        Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\Context,
        Magento\Framework\Model\ResourceModel\AbstractResource,
        Magento\Sales\Api\OrderRepositoryInterface as MagentoOrderRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\CustomerRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\InvoiceDetailsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\LineItemRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Order as ResourceModel;

    class Order
    extends AbstractModel
    implements OrderInterface
    {
        protected const
            FIELD_CUSTOMER          = 'customer',
            FIELD_INVOICE_DETAILS   = 'invoice_details',
            FIELD_LINE_ITEMS        = 'line_items',
            FIELD_ACCEPT_OPTIONS    = 'accept_options',
            FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id',
            FIELD_REJECT_OPTIONS    = 'reject_options',
            FIELD_REJECT_OPTIONS_ID = 'reject_options_id',
            FIELD_MAGENTO_ORDER     = 'magento_order';

        /**
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\CustomerRepositoryInterface $customerRepository
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\InvoiceDetailsRepositoryInterface $invoiceDetailsRepository
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\LineItemRepositoryInterface $lineItemRepository
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface $rejectOptionsRepository
         * @param \Magento\Sales\Api\OrderRepositoryInterface $magentoOrderRepository
         * @param \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
         * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
         * @param \Magento\Framework\Data\Collection\AbstractDb\AbstractDb|null $resourceCollection
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            CustomerRepositoryInterface $customerRepository,
            InvoiceDetailsRepositoryInterface $invoiceDetailsRepository,
            LineItemRepositoryInterface $lineItemRepository,
            AcceptOptionsRepositoryInterface $acceptOptionsRepository,
            RejectOptionsRepositoryInterface $rejectOptionsRepository,
            MagentoOrderRepositoryInterface $magentoOrderRepository,
            SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
            AbstractResource $resource = null,
            AbstractDb $resourceCollection = null,
            array $data = []
        )
        {
            parent::__construct(
                $context,
                $registry,
                $resource,
                $resourceCollection
            );
            $this->_customerRepository              = $customerRepository;
            $this->_invoiceDetailsRepository        = $invoiceDetailsRepository;
            $this->_lineItemRepository              = $lineItemRepository;
            $this->_acceptOptionsRepository         = $acceptOptionsRepository;
            $this->_rejectOptionsRepository         = $rejectOptionsRepository;
            $this->_magentoOrderRepository          = $magentoOrderRepository;
            $this->_searchCriteriaBuilderFactory    = $searchCriteriaBuilderFactory;
        }

        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getCode(): string
        {
            return $this->getData(ResourceModel::FIELD_CODE);
        }
        /**
         * @inheritdoc
         */
        public function setCode(string $code)
        {
            return $this->setData(ResourceModel::FIELD_CODE, $code);
        }

        /**
         * @inheritdoc
         */
        public function getState(): string
        {
            return $this->getData(ResourceModel::FIELD_STATE);
        }
        /**
         * @inheritdoc
         */
        public function setState(string $state)
        {
            return $this->setData(ResourceModel::FIELD_STATE, $state);
        }

        /**
         * @inheritdoc
         */
        public function getCustomer()
        {
            $customer   = $this->getData(self::FIELD_CUSTOMER);
            $customerId = $this->getData(ResourceModel::FIELD_CUSTOMER_ID);
            if (!$customer && $customerId)
            {
                $customer = $this->getCustomerRepository()->getById($customerId);
                $this->setCustomer($customer);
            }
            return $customer;
        }

        /**
         * @inheritdoc
         */
        public function setCustomer($customer)
        {
            $this->setData(ResourceModel::FIELD_CUSTOMER_ID, $customer ? $customer->getId() : null);
            return $this->setData(self::FIELD_CUSTOMER, $customer);
        }

        /**
         * @inheritdoc
         */
        public function getInvoiceDetails()
        {
            $invoiceDetails     = $this->getData(self::FIELD_INVOICE_DETAILS);
            $invoiceDetailsId   = $this->getData(ResourceModel::FIELD_INVOICE_DETAILS_ID);
            if (!$invoiceDetails && $invoiceDetailsId)
            {
                $invoiceDetails = $this->getInvoiceDetailsRepository()->getById($invoiceDetailsId);
                $this->setInvoiceDetails($invoiceDetails);
            }
            return $invoiceDetails;
        }
        /**
         * @inheritdoc
         */
        public function setInvoiceDetails($invoiceDetails)
        {
            $this->setData(ResourceModel::FIELD_INVOICE_DETAILS_ID, $invoiceDetails ? $invoiceDetails->getId() : null);
            return $this->setData(self::FIELD_INVOICE_DETAILS, $invoiceDetails);
        }

        /**
         * @inheritdoc
         */
        public function getInvoice(): bool
        {
            return (bool) $this->getData(ResourceModel::FIELD_INVOICE);
        }
        /**
         * @inheritdoc
         */
        public function setInvoice(bool $invoice)
        {
            return $this->setData(ResourceModel::FIELD_INVOICE, $invoice);
        }

        /**
         * @inheritdoc
         */
        public function getComments(): string
        {
            return $this->getData(ResourceModel::FIELD_COMMENTS);
        }
        /**
         * @inheritdoc
         */
        public function setComments(string $comments)
        {
            return $this->setData(ResourceModel::FIELD_COMMENTS, $comments);
        }

        /**
         * @inheritdoc
         */
        public function getLineItems() : array
        {
            $lineItems = $this->getData(self::FIELD_LINE_ITEMS);
            if (!$lineItems) {
                $lineItems = $this->getLineItemRepository()
                    ->getList(
                        $this->getSearchCriteriaBuilderFactory()
                            ->create()
                            ->addFilter(self::LINE_ITEM_FIELD_ORDER_ID, $this->getId())
                            ->create()
                    )
                    ->getItems();
                $this->setLineItems($lineItems);
            }
            return $lineItems;
        }

        /**
         * @inheritdoc
         */
        public function setLineItems(array $lineItems)
        {
            return $this->setData(self::FIELD_LINE_ITEMS, $lineItems);
        }

        /**
         * @inheritdoc
         */
        public function getCourier(): string
        {
            return $this->getData(ResourceModel::FIELD_COURIER);
        }
        /**
         * @inheritdoc
         */
        public function setCourier(string $courier)
        {
            return $this->setData(ResourceModel::FIELD_COURIER, $courier);
        }

        /**
         * @inheritdoc
         */
        public function getCourierVoucher()
        {
            return $this->getData(ResourceModel::FIELD_COURIER_VOUCHER);
        }

        /**
         * @inheritdoc
         */
        public function setCourierVoucher($courierVoucher)
        {
            return $this->setData(ResourceModel::FIELD_COURIER_VOUCHER, $courierVoucher);
        }

        /**
         * @inheritdoc
         */
        public function getCourierTrackingCodes(): array
        {
            return $this->getData(ResourceModel::FIELD_COURIER_TRACKING_CODES);
        }

        /**
         * @inheritdoc
         */
        public function setCourierTrackingCodes(array $courierTrackingCodes)
        {
            return $this->setData(ResourceModel::FIELD_COURIER_TRACKING_CODES, $courierTrackingCodes);
        }

        /**
         * @inheritdoc
         */
        public function getCreatedAt(): string
        {
            return $this->getData(ResourceModel::FIELD_CREATED_AT);
        }

        /**
         * @inheritdoc
         */
        public function setCreatedAt(string $createdAt)
        {
            return $this->setData(ResourceModel::FIELD_CREATED_AT, $createdAt);
        }

        /**
         * @inheritdoc
         */
        public function getExpiresAt(): string
        {
            return $this->getData(ResourceModel::FIELD_EXPIRES_AT);
        }

        /**
         * @inheritdoc
         */
        public function setExpiresAt(string $expiresAt)
        {
            return $this->setData(ResourceModel::FIELD_EXPIRES_AT, $expiresAt);
        }

        /**
         * @inheritdoc
         */
        public function getDispatchUntil(): string
        {
            return $this->getData(ResourceModel::FIELD_DISPATCH_UNTIL);
        }

        /**
         * @inheritdoc
         */
        public function setDispatchUntil(string $dispatchUntil)
        {
            return $this->setData(ResourceModel::FIELD_DISPATCH_UNTIL, $dispatchUntil);
        }

        /**
         * @inheritdoc
         */
        public function getAcceptOptions()
        {
            $acceptOptions      = $this->getData(self::FIELD_ACCEPT_OPTIONS);
            $acceptOptionsId    = $this->getData(self::FIELD_ACCEPT_OPTIONS_ID);
            if ($acceptOptionsId && !$acceptOptions)
            {
                $acceptOptions = $this->getAcceptOptionsRepository()->getById($acceptOptionsId);
                $this->setAcceptOptions($acceptOptions);
            }
            return $acceptOptions;
        }

        /**
         * @inheritdoc
         */
        public function setAcceptOptions($acceptOptions)
        {
            $acceptOptions->setOrder($this);
            $this->setData(self::FIELD_ACCEPT_OPTIONS_ID, $acceptOptions->getId());
            return $this->setData(self::FIELD_ACCEPT_OPTIONS, $acceptOptions);
        }

        /**
         * @inheritdoc
         */
        public function getRejectOptions()
        {
            $rejectOptions      = $this->getData(self::FIELD_REJECT_OPTIONS);
            $rejectOptionsId    = $this->getData(self::FIELD_REJECT_OPTIONS_ID);
            if ($rejectOptionsId && !$rejectOptions)
            {
                $rejectOptions = $this->getAcceptOptionsRepository()->getById($rejectOptionsId);
                $this->setRejectOptions($rejectOptions);
            }
            return $rejectOptions;
        }

        /**
         * @inheritdoc
         */
        public function setRejectOptions($rejectOptions)
        {
            $rejectOptions->setOrder($this);
            $this->setData(self::FIELD_REJECT_OPTIONS_ID, $rejectOptions->getId());
            return $this->setData(self::FIELD_REJECT_OPTIONS, $rejectOptions);
        }

        /**
         * @inheritdoc
         */
        public function getMagentoOrder()
        {
            $magentoOrder   = $this->getData(self::FIELD_MAGENTO_ORDER);
            $magentoOrderId = $this->getData(ResourceModel::FIELD_MAGENTO_ORDER_ID);
            if ($magentoOrderId && !$magentoOrder)
            {
                $magentoOrder = $this->getMagentoOrderRepository()->get($magentoOrderId);
                $this->setMagentoOrder($magentoOrder);
            }
            return $magentoOrder;
        }

        /**
         * @inheritdoc
         */
        public function setMagentoOrder($magentoOrder)
        {
            $this->setData(ResourceModel::FIELD_MAGENTO_ORDER_ID, $magentoOrder ? $magentoOrder->getEntityId() : null);
            return $this->setData(self::FIELD_MAGENTO_ORDER, $magentoOrder);
        }

        /**
         * @inheritdoc
         */
        public function getExpress(): bool
        {
            return (bool) $this->getData(ResourceModel::FIELD_EXPRESS);
        }

        /**
         * @inheritdoc
         */
        public function setExpress(bool $express)
        {
            return $this->setData(ResourceModel::FIELD_EXPRESS, (string) $express);
        }

        /**
         * @inheritdoc
         */
        public function getCustom(): bool
        {
            return (bool) $this->getData(ResourceModel::FIELD_CUSTOM);
        }

        /**
         * @inheritdoc
         */
        public function setCustom(bool $custom)
        {
            return $this->setData(ResourceModel::FIELD_CUSTOM, (string) $custom);
        }

        /**
         * Customer Repository property
         *
         * @var \Hippiemonkeys\SkroutzSmartCart\Api\CustomerRepositoryInterface $_customerRepository
         */
        private $_customerRepository;

        /**
         * Gets Customer Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\CustomerRepositoryInterface
         */
        protected function getCustomerRepository(): CustomerRepositoryInterface
        {
            return $this->_customerRepository;
        }

        /**
         * Invoice Details property
         *
         * @var \Hippiemonkeys\SkroutzSmartCart\Api\InvoiceDetailsRepositoryInterface $_invoiceDetailsRepository
         */
        private $_invoiceDetailsRepository;

        /**
         * Gets Invoice Details
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\InvoiceDetailsRepositoryInterface
         */
        protected function getInvoiceDetailsRepository(): InvoiceDetailsRepositoryInterface
        {
            return $this->_invoiceDetailsRepository;
        }

        /**
         * Line Item Repository property
         *
         * @var \Hippiemonkeys\SkroutzSmartCart\Api\LineItemRepositoryInterface $_lineItemRepository
         */
        private $_lineItemRepository;

        /**
         * Gets Line Item Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\LineItemRepositoryInterface
         */
        protected function getLineItemRepository(): LineItemRepositoryInterface
        {
            return $this->_lineItemRepository;
        }

        /**
         * Accept Options Repository property
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface $_acceptOptionsRepository
         */
        private $_acceptOptionsRepository;

        /**
         * Gets Accept Options Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface
         */
        protected function getAcceptOptionsRepository(): AcceptOptionsRepositoryInterface
        {
            return $this->_acceptOptionsRepository;
        }

        /**
         * Reject Options Repository property
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface $_rejectOptionsRepository
         */
        private $_rejectOptionsRepository;

        /**
         * Gets Reject Options Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface
         */
        protected function getRejectOptionsRepository(): RejectOptionsRepositoryInterface
        {
            return $this->_rejectOptionsRepository;
        }

        /**
         * Magento Order Repository property
         *
         * @var \Magento\Sales\Api\OrderRepositoryInterface $_magentoOrderRepository
         */
        private $_magentoOrderRepository;

        /**
         * Gets Magento Order Repository
         *
         * @return \Magento\Sales\Api\OrderRepositoryInterface
         */
        protected function getMagentoOrderRepository(): MagentoOrderRepositoryInterface
        {
            return $this->_magentoOrderRepository;
        }

        /**
         * Search Criteria Builder Factory property
         *
         * @var \Magento\Framework\Api\SearchCriteriaBuilderFactory $_searchCriteriaBuilderFactory
         */
        private $_searchCriteriaBuilderFactory;

        /**
         * Gets Search Criteria Builder Factory
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilderFactory
         */
        protected function getSearchCriteriaBuilderFactory(): SearchCriteriaBuilderFactory
        {
            return $this->_searchCriteriaBuilderFactory;
        }
    }
?>