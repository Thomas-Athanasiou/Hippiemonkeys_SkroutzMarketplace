<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Api\SearchCriteriaBuilderFactory,
        Magento\Framework\Registry,
        Magento\Framework\Data\Collection\AbstractDb,
        Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\Context,
        Magento\Framework\Model\ResourceModel\AbstractResource,
        Magento\Sales\Api\OrderRepositoryInterface as MagentoOrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Order as ResourceModel;

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
            FIELD_REJECTION_INFO    = 'rejection_info',
            FIELD_REJECTION_INFO_ID = 'rejection_info_id',
            FIELD_PICKUP_WINDOW     = 'pickup_window',
            FIELD_PICKUP_WINDOW_ID  = 'pickup_window_id',
            FIELD_MAGENTO_ORDER     = 'magento_order';

        /**
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface $customerRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface $invoiceDetailsRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface $lineItemRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface $rejectOptionsRepository
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
        public function getRejectionInfo(): ?RejectionInfoInterface
        {
            $rejectionInfo      = $this->getData(self::FIELD_REJECTION_INFO);
            $rejectionInfoId    = $this->getData(ResourceModel::FIELD_REJECTION_INFO_ID);
            if (!$rejectionInfo && $rejectionInfoId)
            {
                /* $rejectionInfo = $this->getRejectionInfoRepository()->getById($rejectionInfoId); */
                $this->setRejectionInfo($rejectionInfo);
            }
            return $rejectionInfo;
        }

        /**
         * @inheritdoc
         */
        public function setRejectionInfo(?RejectionInfoInterface $rejectionInfo)
        {
            $this->setData(ResourceModel::FIELD_REJECTION_INFO_ID, $rejectionInfo ? $rejectionInfo->getId() : null);
            return $this->setData(self::FIELD_REJECTION_INFO, $rejectionInfo);
        }

        /**
         * @inheritdoc
         */
        public function getAcceptOptions()
        {
            $acceptOptions      = $this->getData(self::FIELD_ACCEPT_OPTIONS);
            $acceptOptionsId    = $this->getData(ResourceModel::FIELD_ACCEPT_OPTIONS_ID);
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
            $this->setData(ResourceModel::FIELD_ACCEPT_OPTIONS_ID, $acceptOptions->getId());
            return $this->setData(self::FIELD_ACCEPT_OPTIONS, $acceptOptions);
        }

        /**
         * @inheritdoc
         */
        public function getRejectOptions()
        {
            $rejectOptions      = $this->getData(self::FIELD_REJECT_OPTIONS);
            $rejectOptionsId    = $this->getData(ResourceModel::FIELD_REJECT_OPTIONS_ID);
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
            $this->setData(ResourceModel::FIELD_REJECT_OPTIONS_ID, $rejectOptions->getId());
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
         * @inheritdoc
         */
        public function getGiftWrap(): bool
        {
            return (bool) $this->getData(ResourceModel::FIELD_GIFT_WRAP);
        }

        /**
         * @inheritdoc
         */
        public function setGiftWrap(bool $giftWrap)
        {
            return $this->setData(ResourceModel::FIELD_GIFT_WRAP, (string) $giftWrap);
        }

        /**
         * @inheritdoc
         */
        public function getFulfilledBySkroutz(): bool
        {
            return (bool) $this->getData(ResourceModel::FIELD_FULFILLED_BY_SKROUTZ);
        }

        /**
         * @inheritdoc
         */
        public function setFulfilledBySkroutz(bool $fulfilledBySkroutz)
        {
            return $this->setData(ResourceModel::FIELD_FULFILLED_BY_SKROUTZ, $fulfilledBySkroutz);
        }

        /**
         * @inheritdoc
         */
        public function getFbsDeliveryNote(): ?string
        {
            return $this->getData(ResourceModel::FIELD_FBS_DELIVERY_NOTE);
        }

        /**
         * @inheritdoc
         */
        public function setFbsDeliveryNote(?string $fbsDeliveryNote)
        {
            return $this->setData(ResourceModel::FIELD_FBS_DELIVERY_NOTE, $fbsDeliveryNote);
        }

        /**
         * @inheritdoc
         */
        public function getPickupWindow(): ?OrderPickupWindowInterface
        {
            $pickupWindow   = $this->getData(self::FIELD_PICKUP_WINDOW);
            $pickupWindowId = $this->getData(ResourceModel::FIELD_PICKUP_WINDOW_ID);
            if (!$pickupWindow && $pickupWindowId)
            {
                /* $pickupWindow = $this->getPickupWindowRepository()->getById($pickupWindowId); */
                $this->setPickupWindow($pickupWindow);
            }
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function setPickupWindow(?OrderPickupWindowInterface $pickupWindow)
        {
            $this->setData(ResourceModel::FIELD_PICKUP_WINDOW_ID, $pickupWindow ? $pickupWindow->getId() : null);
            return $this->setData(self::FIELD_PICKUP_WINDOW, $pickupWindow);
        }

        /**
         * @inheritdoc
         */
        public function getPickupAddress(): ?string
        {
            return $this->getData(ResourceModel::FIELD_PICKUP_ADDRESS);
        }

        /**
         * @inheritdoc
         */
        public function setPickupAddress(?string $pickupAddress)
        {
            return $this->setData(ResourceModel::FIELD_PICKUP_ADDRESS, $pickupAddress);
        }

        /**
         * @inheritdoc
         */
        public function getNumberOfParcels(): ?int
        {
            return (int) $this->getData(ResourceModel::FIELD_NUMBER_OF_PARCELS);
        }

        /**
         * @inheritdoc
         */
        public function setNumberOfParcels(?int $numberOfParcels)
        {
            return $this->setData(ResourceModel::FIELD_NUMBER_OF_PARCELS, (string) $numberOfParcels);
        }

        /**
         * Customer Repository property
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface $_customerRepository
         */
        private $_customerRepository;

        /**
         * Gets Customer Repository
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface
         */
        protected function getCustomerRepository(): CustomerRepositoryInterface
        {
            return $this->_customerRepository;
        }

        /**
         * Invoice Details property
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface $_invoiceDetailsRepository
         */
        private $_invoiceDetailsRepository;

        /**
         * Gets Invoice Details
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface
         */
        protected function getInvoiceDetailsRepository(): InvoiceDetailsRepositoryInterface
        {
            return $this->_invoiceDetailsRepository;
        }

        /**
         * Line Item Repository property
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface $_lineItemRepository
         */
        private $_lineItemRepository;

        /**
         * Gets Line Item Repository
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface
         */
        protected function getLineItemRepository(): LineItemRepositoryInterface
        {
            return $this->_lineItemRepository;
        }

        /**
         * Accept Options Repository property
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $_acceptOptionsRepository
         */
        private $_acceptOptionsRepository;

        /**
         * Gets Accept Options Repository
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface
         */
        protected function getAcceptOptionsRepository(): AcceptOptionsRepositoryInterface
        {
            return $this->_acceptOptionsRepository;
        }

        /**
         * Reject Options Repository property
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface $_rejectOptionsRepository
         */
        private $_rejectOptionsRepository;

        /**
         * Gets Reject Options Repository
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface
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