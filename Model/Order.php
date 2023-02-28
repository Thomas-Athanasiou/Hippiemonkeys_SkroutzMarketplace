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

    use Magento\Framework\Api\SearchCriteriaBuilder,
        Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Magento\Sales\Api\Data\OrderInterface as MagentoOrderInterface,
        Magento\Sales\Api\OrderRepositoryInterface as MagentoOrderRepositoryInterface,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface as ResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface;

    class Order
    extends AbstractModel
    implements OrderInterface
    {
        protected const
            FIELD_CUSTOMER = 'customer',
            FIELD_INVOICE_DETAILS = 'invoice_details',
            FIELD_LINE_ITEMS = 'line_items',
            FIELD_ACCEPT_OPTIONS = 'accept_options',
            FIELD_REJECT_OPTIONS = 'reject_options',
            FIELD_REJECTION_INFO = 'rejection_info',
            FIELD_PICKUP_WINDOW = 'pickup_window',
            FIELD_MAGENTO_ORDER = 'magento_order';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface $customerRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface $invoiceDetailsRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface $lineItemRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface $rejectOptionsRepository
         * @param \Magento\Sales\Api\OrderRepositoryInterface $magentoOrderRepository
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
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
            SearchCriteriaBuilder $searchCriteriaBuilder,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

            $this->_customerRepository = $customerRepository;
            $this->_invoiceDetailsRepository = $invoiceDetailsRepository;
            $this->_lineItemRepository = $lineItemRepository;
            $this->_acceptOptionsRepository = $acceptOptionsRepository;
            $this->_rejectOptionsRepository = $rejectOptionsRepository;
            $this->_magentoOrderRepository = $magentoOrderRepository;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * {@inheritdoc}
         */
        public function getCode(): string
        {
            return $this->getData(ResourceInterface::FIELD_CODE);
        }

        /**
         * {@inheritdoc}
         */
        public function setCode(string $code): Order
        {
            return $this->setData(ResourceInterface::FIELD_CODE, $code);
        }

        /**
         * {@inheritdoc}
         */
        public function getState(): string
        {
            return $this->getData(ResourceInterface::FIELD_STATE);
        }

        /**
         * {@inheritdoc}
         */
        public function setState(string $state): Order
        {
            return $this->setData(ResourceInterface::FIELD_STATE, $state);
        }

        /**
         * {@inheritdoc}
         */
        public function getCustomer(): ?CustomerInterface
        {
            $customer   = $this->getData(static::FIELD_CUSTOMER);
            $customerId = $this->getData(ResourceInterface::FIELD_CUSTOMER_ID);
            if (!$customer && $customerId)
            {
                $customer = $this->getCustomerRepository()->getById($customerId);
                $this->setCustomer($customer);
            }
            return $customer;
        }

        /**
         * {@inheritdoc}
         */
        public function setCustomer(?CustomerInterface $customer): Order
        {
            $this->setData(ResourceInterface::FIELD_CUSTOMER_ID, $customer ? $customer->getId() : null);
            return $this->setData(static::FIELD_CUSTOMER, $customer);
        }

        /**
         * {@inheritdoc}
         */
        public function getInvoiceDetails(): ?InvoiceDetailsInterface
        {
            $invoiceDetails = $this->getData(static::FIELD_INVOICE_DETAILS);
            $invoiceDetailsId = $this->getData(ResourceInterface::FIELD_INVOICE_DETAILS_ID);
            if (!$invoiceDetails && $invoiceDetailsId)
            {
                $invoiceDetails = $this->getInvoiceDetailsRepository()->getById($invoiceDetailsId);
                $this->setInvoiceDetails($invoiceDetails);
            }
            return $invoiceDetails;
        }

        /**
         * {@inheritdoc}
         */
        public function setInvoiceDetails(?InvoiceDetailsInterface $invoiceDetails): Order
        {
            $this->setData(ResourceInterface::FIELD_INVOICE_DETAILS_ID, $invoiceDetails ? $invoiceDetails->getId() : null);
            return $this->setData(static::FIELD_INVOICE_DETAILS, $invoiceDetails);
        }

        /**
         * {@inheritdoc}
         */
        public function getInvoice(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_INVOICE);
        }

        /**
         * {@inheritdoc}
         */
        public function setInvoice(bool $invoice): Order
        {
            return $this->setData(ResourceInterface::FIELD_INVOICE, $invoice);
        }

        /**
         * {@inheritdoc}
         */
        public function getComments(): string
        {
            return $this->getData(ResourceInterface::FIELD_COMMENTS);
        }

        /**
         * {@inheritdoc}
         */
        public function setComments(string $comments): Order
        {
            return $this->setData(ResourceInterface::FIELD_COMMENTS, $comments);
        }

        /**
         * {@inheritdoc}
         */
        public function getLineItems() : array
        {
            $lineItems = $this->getData(static::FIELD_LINE_ITEMS);
            if ($lineItems === null)
            {
                $lineItems = $this->getLineItemRepository()
                    ->getList(
                        $this->getSearchCriteriaBuilder()
                            ->addFilter(LineItemResourceInterface::FIELD_ORDER_ID, $this->getId())
                            ->create()
                    )
                    ->getItems();
                $this->setLineItems($lineItems);
            }
            return $lineItems;
        }

        /**
         * {@inheritdoc}
         */
        public function setLineItems(array $lineItems): Order
        {
            return $this->setData(static::FIELD_LINE_ITEMS, $lineItems);
        }

        /**
         * {@inheritdoc}
         */
        public function getCourier(): string
        {
            return $this->getData(ResourceInterface::FIELD_COURIER);
        }

        /**
         * {@inheritdoc}
         */
        public function setCourier(string $courier): Order
        {
            return $this->setData(ResourceInterface::FIELD_COURIER, $courier);
        }

        /**
         * {@inheritdoc}
         */
        public function getCourierVoucher(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_COURIER_VOUCHER);
        }

        /**
         * {@inheritdoc}
         */
        public function setCourierVoucher(?string $courierVoucher): Order
        {
            return $this->setData(ResourceInterface::FIELD_COURIER_VOUCHER, $courierVoucher);
        }

        /**
         * {@inheritdoc}
         */
        public function getCourierTrackingCodes(): array
        {
            return $this->getData(ResourceInterface::FIELD_COURIER_TRACKING_CODES);
        }

        /**
         * {@inheritdoc}
         */
        public function setCourierTrackingCodes(array $courierTrackingCodes): Order
        {
            return $this->setData(ResourceInterface::FIELD_COURIER_TRACKING_CODES, $courierTrackingCodes);
        }

        /**
         * {@inheritdoc}
         */
        public function getCreatedAt(): string
        {
            return $this->getData(ResourceInterface::FIELD_CREATED_AT);
        }

        /**
         * {@inheritdoc}
         */
        public function setCreatedAt(string $createdAt): Order
        {
            return $this->setData(ResourceInterface::FIELD_CREATED_AT, $createdAt);
        }

        /**
         * {@inheritdoc}
         */
        public function getExpiresAt(): string
        {
            return $this->getData(ResourceInterface::FIELD_EXPIRES_AT);
        }

        /**
         * {@inheritdoc}
         */
        public function setExpiresAt(string $expiresAt): Order
        {
            return $this->setData(ResourceInterface::FIELD_EXPIRES_AT, $expiresAt);
        }

        /**
         * {@inheritdoc}
         */
        public function getDispatchUntil(): string
        {
            return $this->getData(ResourceInterface::FIELD_DISPATCH_UNTIL);
        }

        /**
         * {@inheritdoc}
         */
        public function setDispatchUntil(string $dispatchUntil): Order
        {
            return $this->setData(ResourceInterface::FIELD_DISPATCH_UNTIL, $dispatchUntil);
        }

        /**
         * {@inheritdoc}
         */
        public function getRejectionInfo(): ?RejectionInfoInterface
        {
            $rejectionInfo = $this->getData(static::FIELD_REJECTION_INFO);
            $rejectionInfoId = $this->getData(ResourceInterface::FIELD_REJECTION_INFO_ID);
            if (!$rejectionInfo && $rejectionInfoId)
            {
                /* $rejectionInfo = $this->getRejectionInfoRepository()->getById($rejectionInfoId); */
                $this->setRejectionInfo($rejectionInfo);
            }
            return $rejectionInfo;
        }

        /**
         * {@inheritdoc}
         */
        public function setRejectionInfo(?RejectionInfoInterface $rejectionInfo): Order
        {
            $this->setData(ResourceInterface::FIELD_REJECTION_INFO_ID, $rejectionInfo ? $rejectionInfo->getId() : null);
            return $this->setData(static::FIELD_REJECTION_INFO, $rejectionInfo);
        }

        /**
         * {@inheritdoc}
         */
        public function getAcceptOptions(): ?AcceptOptionsInterface
        {
            $acceptOptions = $this->getData(static::FIELD_ACCEPT_OPTIONS);
            $acceptOptionsId = $this->getData(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID);
            if ($acceptOptionsId && !$acceptOptions)
            {
                $acceptOptions = $this->getAcceptOptionsRepository()->getById($acceptOptionsId);
                $this->setAcceptOptions($acceptOptions);
            }
            return $acceptOptions;
        }

        /**
         * {@inheritdoc}
         */
        public function setAcceptOptions(?AcceptOptionsInterface $acceptOptions): Order
        {
            $acceptOptions->setOrder($this);
            $this->setData(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID, $acceptOptions->getId());
            return $this->setData(static::FIELD_ACCEPT_OPTIONS, $acceptOptions);
        }

        /**
         * {@inheritdoc}
         */
        public function getRejectOptions(): ?RejectOptionsInterface
        {
            $rejectOptions = $this->getData(static::FIELD_REJECT_OPTIONS);
            $rejectOptionsId = $this->getData(ResourceInterface::FIELD_REJECT_OPTIONS_ID);
            if ($rejectOptionsId && !$rejectOptions)
            {
                $rejectOptions = $this->getRejectOptionsRepository()->getById($rejectOptionsId);
                $this->setRejectOptions($rejectOptions);
            }
            return $rejectOptions;
        }

        /**
         * {@inheritdoc}
         */
        public function setRejectOptions(?RejectOptionsInterface $rejectOptions): Order
        {
            $rejectOptions->setOrder($this);
            $this->setData(ResourceInterface::FIELD_REJECT_OPTIONS_ID, $rejectOptions->getId());
            return $this->setData(static::FIELD_REJECT_OPTIONS, $rejectOptions);
        }

        /**
         * {@inheritdoc}
         */
        public function getMagentoOrder(): ?MagentoOrderInterface
        {
            $magentoOrder = $this->getData(static::FIELD_MAGENTO_ORDER);
            $magentoOrderId = $this->getData(ResourceInterface::FIELD_MAGENTO_ORDER_ID);
            if ($magentoOrderId !== null && $magentoOrder === null)
            {
                $magentoOrder = $this->getMagentoOrderRepository()->get($magentoOrderId);
                $this->setData(static::FIELD_MAGENTO_ORDER, $magentoOrder);
            }
            return $magentoOrder;
        }

        /**
         * {@inheritdoc}
         */
        public function setMagentoOrder(?MagentoOrderInterface $magentoOrder): Order
        {
            $this->setData(ResourceInterface::FIELD_MAGENTO_ORDER_ID, $magentoOrder ? $magentoOrder->getEntityId() : null);
            return $this->setData(static::FIELD_MAGENTO_ORDER, $magentoOrder);
        }

        /**
         * {@inheritdoc}
         */
        public function getExpress(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_EXPRESS);
        }

        /**
         * {@inheritdoc}
         */
        public function setExpress(bool $express): Order
        {
            return $this->setData(ResourceInterface::FIELD_EXPRESS, (string) $express);
        }

        /**
         * {@inheritdoc}
         */
        public function getCustom(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_CUSTOM);
        }

        /**
         * {@inheritdoc}
         */
        public function setCustom(bool $custom): Order
        {
            return $this->setData(ResourceInterface::FIELD_CUSTOM, (string) $custom);
        }

        /**
         * {@inheritdoc}
         */
        public function getGiftWrap(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_GIFT_WRAP);
        }

        /**
         * {@inheritdoc}
         */
        public function setGiftWrap(bool $giftWrap): Order
        {
            return $this->setData(ResourceInterface::FIELD_GIFT_WRAP, (string) $giftWrap);
        }

        /**
         * {@inheritdoc}
         */
        public function getFulfilledBySkroutz(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_FULFILLED_BY_SKROUTZ);
        }

        /**
         * {@inheritdoc}
         */
        public function setFulfilledBySkroutz(bool $fulfilledBySkroutz): Order
        {
            return $this->setData(ResourceInterface::FIELD_FULFILLED_BY_SKROUTZ, $fulfilledBySkroutz);
        }

        /**
         * {@inheritdoc}
         */
        public function getFbsDeliveryNote(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_FBS_DELIVERY_NOTE);
        }

        /**
         * {@inheritdoc}
         */
        public function setFbsDeliveryNote(?string $fbsDeliveryNote): Order
        {
            return $this->setData(ResourceInterface::FIELD_FBS_DELIVERY_NOTE, $fbsDeliveryNote);
        }

        /**
         * {@inheritdoc}
         */
        public function getStorePickup(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_STORE_PICKUP);
        }

        /**
         * {@inheritdoc}
         */
        public function setStorePickup(bool $storePickup): Order
        {
            return $this->setData(ResourceInterface::FIELD_STORE_PICKUP, $storePickup);
        }

        /**
         * {@inheritdoc}
         */
        public function getPickupWindow(): ?OrderPickupWindowInterface
        {
            $pickupWindow = $this->getData(static::FIELD_PICKUP_WINDOW);
            $pickupWindowId = $this->getData(ResourceInterface::FIELD_PICKUP_WINDOW_ID);
            if (!$pickupWindow && $pickupWindowId)
            {
                /* $pickupWindow = $this->getPickupWindowRepository()->getById($pickupWindowId); */
                $this->setPickupWindow($pickupWindow);
            }
            return $pickupWindow;
        }

        /**
         * {@inheritdoc}
         */
        public function setPickupWindow(?OrderPickupWindowInterface $pickupWindow): Order
        {
            $this->setData(ResourceInterface::FIELD_PICKUP_WINDOW_ID, $pickupWindow ? $pickupWindow->getId() : null);
            return $this->setData(static::FIELD_PICKUP_WINDOW, $pickupWindow);
        }

        /**
         * {@inheritdoc}
         */
        public function getPickupAddress(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_PICKUP_ADDRESS);
        }

        /**
         * {@inheritdoc}
         */
        public function setPickupAddress(?string $pickupAddress): Order
        {
            return $this->setData(ResourceInterface::FIELD_PICKUP_ADDRESS, $pickupAddress);
        }

        /**
         * {@inheritdoc}
         */
        public function getNumberOfParcels(): ?int
        {
            return (int) $this->getData(ResourceInterface::FIELD_NUMBER_OF_PARCELS);
        }

        /**
         * {@inheritdoc}
         */
        public function setNumberOfParcels(?int $numberOfParcels): Order
        {
            return $this->setData(ResourceInterface::FIELD_NUMBER_OF_PARCELS, (string) $numberOfParcels);
        }

        /**
         * Customer Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface $_customerRepository
         */
        private $_customerRepository;

        /**
         * Gets Customer Repository
         *
         * @access protected
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
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface $_invoiceDetailsRepository
         */
        private $_invoiceDetailsRepository;

        /**
         * Gets Invoice Details
         *
         * @access protected
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
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface $_lineItemRepository
         */
        private $_lineItemRepository;

        /**
         * Gets Line Item Repository
         *
         * @access protected
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
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $_acceptOptionsRepository
         */
        private $_acceptOptionsRepository;

        /**
         * Gets Accept Options Repository
         *
         * @access protected
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
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface $_rejectOptionsRepository
         */
        private $_rejectOptionsRepository;

        /**
         * Gets Reject Options Repository
         *
         * @access protected
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
         * @access private
         *
         * @var \Magento\Sales\Api\OrderRepositoryInterface $_magentoOrderRepository
         */
        private $_magentoOrderRepository;

        /**
         * Gets Magento Order Repository
         *
         * @access protected
         *
         * @return \Magento\Sales\Api\OrderRepositoryInterface
         */
        protected function getMagentoOrderRepository(): MagentoOrderRepositoryInterface
        {
            return $this->_magentoOrderRepository;
        }

        /**
         * Search Criteria Builder property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteriaBuilder $_searchCriteriaBuilder
         */
        private $_searchCriteriaBuilder;

        /**
         * Gets Search Criteria Builder
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected function getSearchCriteriaBuilder(): SearchCriteriaBuilder
        {
            return $this->_searchCriteriaBuilder;
        }
    }
?>