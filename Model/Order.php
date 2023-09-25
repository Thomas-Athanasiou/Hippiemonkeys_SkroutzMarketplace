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

            $this->customerRepository = $customerRepository;
            $this->invoiceDetailsRepository = $invoiceDetailsRepository;
            $this->lineItemRepository = $lineItemRepository;
            $this->acceptOptionsRepository = $acceptOptionsRepository;
            $this->rejectOptionsRepository = $rejectOptionsRepository;
            $this->magentoOrderRepository = $magentoOrderRepository;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;

            $this->customer = null;
            $this->invoiceDetails = null;
            $this->lineItem = null;
            $this->acceptOptions = null;
            $this->rejectOptions = null;
            $this->magentoOrder = null;
        }

        /**
         * @inheritdoc
         */
        public function getCode(): string
        {
            return $this->getData(ResourceInterface::FIELD_CODE);
        }

        /**
         * @inheritdoc
         */
        public function setCode(string $code): self
        {
            return $this->setData(ResourceInterface::FIELD_CODE, $code);
        }

        /**
         * @inheritdoc
         */
        public function getState(): string
        {
            return $this->getData(ResourceInterface::FIELD_STATE);
        }

        /**
         * @inheritdoc
         */
        public function setState(string $state): self
        {
            return $this->setData(ResourceInterface::FIELD_STATE, $state);
        }

        /**
         * Customer property
         *
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface|null $customer
         */
        private $customer;

        /**
         * @inheritdoc
         */
        public function getCustomer(): ?CustomerInterface
        {
            $customer = $this->customer;
            if($customer === null)
            {
                $customerId = $this->getData(ResourceInterface::FIELD_CUSTOMER_ID);
                if ($customerId !== null)
                {
                    $customer = $this->getCustomerRepository()->getById($customerId);
                    $this->customer = $customer;
                }
            }
            return $customer;
        }

        /**
         * @inheritdoc
         */
        public function setCustomer(?CustomerInterface $customer): self
        {
            $this->customer = $customer;
            return $this->setData(ResourceInterface::FIELD_CUSTOMER_ID, $customer ? $customer->getId() : null);
        }

        /**
         * Invoice Details property
         *
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface|null $invoiceDetails
         */
        private $invoiceDetails;

        /**
         * @inheritdoc
         */
        public function getInvoiceDetails(): ?InvoiceDetailsInterface
        {

            $invoiceDetails = $this->invoiceDetails;
            if($invoiceDetails === null)
            {
                $invoiceDetailsId = $this->getData(ResourceInterface::FIELD_INVOICE_DETAILS_ID);
                if ($invoiceDetailsId !== null)
                {
                    $invoiceDetails = $this->getInvoiceDetailsRepository()->getById($invoiceDetailsId);
                    $this->invoiceDetails = $invoiceDetails;
                }
            }
            return $invoiceDetails;
        }

        /**
         * @inheritdoc
         */
        public function setInvoiceDetails(?InvoiceDetailsInterface $invoiceDetails): self
        {
            $this->invoiceDetails = $invoiceDetails;
            return $this->setData(ResourceInterface::FIELD_INVOICE_DETAILS_ID, $invoiceDetails ? $invoiceDetails->getId() : null);
        }

        /**
         * @inheritdoc
         */
        public function getInvoice(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_INVOICE);
        }

        /**
         * @inheritdoc
         */
        public function setInvoice(bool $invoice): self
        {
            return $this->setData(ResourceInterface::FIELD_INVOICE, $invoice);
        }

        /**
         * @inheritdoc
         */
        public function getComments(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_COMMENTS);
        }

        /**
         * @inheritdoc
         */
        public function setComments(?string $comments): self
        {
            return $this->setData(ResourceInterface::FIELD_COMMENTS, $comments);
        }

        /**
         * @inheritdoc
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
         * @inheritdoc
         */
        public function setLineItems(array $lineItems): self
        {
            return $this->setData(static::FIELD_LINE_ITEMS, $lineItems);
        }

        /**
         * @inheritdoc
         */
        public function getCourier(): string
        {
            return $this->getData(ResourceInterface::FIELD_COURIER);
        }

        /**
         * @inheritdoc
         */
        public function setCourier(string $courier): self
        {
            return $this->setData(ResourceInterface::FIELD_COURIER, $courier);
        }

        /**
         * @inheritdoc
         */
        public function getCourierVoucher(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_COURIER_VOUCHER);
        }

        /**
         * @inheritdoc
         */
        public function setCourierVoucher(?string $courierVoucher): self
        {
            return $this->setData(ResourceInterface::FIELD_COURIER_VOUCHER, $courierVoucher);
        }

        /**
         * @inheritdoc
         */
        public function getCourierTrackingCodes(): array
        {
            return $this->getData(ResourceInterface::FIELD_COURIER_TRACKING_CODES);
        }

        /**
         * @inheritdoc
         */
        public function setCourierTrackingCodes(array $courierTrackingCodes): self
        {
            return $this->setData(ResourceInterface::FIELD_COURIER_TRACKING_CODES, $courierTrackingCodes);
        }

        /**
         * @inheritdoc
         */
        public function getCreatedAt(): string
        {
            return $this->getData(ResourceInterface::FIELD_CREATED_AT);
        }

        /**
         * @inheritdoc
         */
        public function setCreatedAt(string $createdAt): self
        {
            return $this->setData(ResourceInterface::FIELD_CREATED_AT, $createdAt);
        }

        /**
         * @inheritdoc
         */
        public function getExpiresAt(): string
        {
            return $this->getData(ResourceInterface::FIELD_EXPIRES_AT);
        }

        /**
         * @inheritdoc
         */
        public function setExpiresAt(string $expiresAt): self
        {
            return $this->setData(ResourceInterface::FIELD_EXPIRES_AT, $expiresAt);
        }

        /**
         * @inheritdoc
         */
        public function getDispatchUntil(): string
        {
            return $this->getData(ResourceInterface::FIELD_DISPATCH_UNTIL);
        }

        /**
         * @inheritdoc
         */
        public function setDispatchUntil(string $dispatchUntil): self
        {
            return $this->setData(ResourceInterface::FIELD_DISPATCH_UNTIL, $dispatchUntil);
        }

        /**
         * @inheritdoc
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
         * @inheritdoc
         */
        public function setRejectionInfo(?RejectionInfoInterface $rejectionInfo): self
        {
            $this->setData(ResourceInterface::FIELD_REJECTION_INFO_ID, $rejectionInfo ? $rejectionInfo->getId() : null);
            return $this->setData(static::FIELD_REJECTION_INFO, $rejectionInfo);
        }

        /**
         * @inheritdoc
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
         * @inheritdoc
         */
        public function setAcceptOptions(?AcceptOptionsInterface $acceptOptions): self
        {
            $acceptOptions->setOrder($this);
            $this->setData(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID, $acceptOptions->getId());
            return $this->setData(static::FIELD_ACCEPT_OPTIONS, $acceptOptions);
        }

        /**
         * @inheritdoc
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
         * @inheritdoc
         */
        public function setRejectOptions(?RejectOptionsInterface $rejectOptions): self
        {
            $rejectOptions->setOrder($this);
            $this->setData(ResourceInterface::FIELD_REJECT_OPTIONS_ID, $rejectOptions->getId());
            return $this->setData(static::FIELD_REJECT_OPTIONS, $rejectOptions);
        }

        /**
         * @inheritdoc
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
         * @inheritdoc
         */
        public function setMagentoOrder(?MagentoOrderInterface $magentoOrder): self
        {
            $this->setData(ResourceInterface::FIELD_MAGENTO_ORDER_ID, $magentoOrder ? $magentoOrder->getEntityId() : null);
            return $this->setData(static::FIELD_MAGENTO_ORDER, $magentoOrder);
        }

        /**
         * @inheritdoc
         */
        public function getExpress(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_EXPRESS);
        }

        /**
         * @inheritdoc
         */
        public function setExpress(bool $express): self
        {
            return $this->setData(ResourceInterface::FIELD_EXPRESS, (string) $express);
        }

        /**
         * @inheritdoc
         */
        public function getCustom(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_CUSTOM);
        }

        /**
         * @inheritdoc
         */
        public function setCustom(bool $custom): self
        {
            return $this->setData(ResourceInterface::FIELD_CUSTOM, (string) $custom);
        }

        /**
         * @inheritdoc
         */
        public function getGiftWrap(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_GIFT_WRAP);
        }

        /**
         * @inheritdoc
         */
        public function setGiftWrap(bool $giftWrap): self
        {
            return $this->setData(ResourceInterface::FIELD_GIFT_WRAP, (string) $giftWrap);
        }

        /**
         * @inheritdoc
         */
        public function getFulfilledBySkroutz(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_FULFILLED_BY_SKROUTZ);
        }

        /**
         * @inheritdoc
         */
        public function setFulfilledBySkroutz(bool $fulfilledBySkroutz): self
        {
            return $this->setData(ResourceInterface::FIELD_FULFILLED_BY_SKROUTZ, $fulfilledBySkroutz);
        }

        /**
         * @inheritdoc
         */
        public function getFbsDeliveryNote(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_FBS_DELIVERY_NOTE);
        }

        /**
         * @inheritdoc
         */
        public function setFbsDeliveryNote(?string $fbsDeliveryNote): self
        {
            return $this->setData(ResourceInterface::FIELD_FBS_DELIVERY_NOTE, $fbsDeliveryNote);
        }

        /**
         * @inheritdoc
         */
        public function getStorePickup(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_STORE_PICKUP);
        }

        /**
         * @inheritdoc
         */
        public function setStorePickup(bool $storePickup): self
        {
            return $this->setData(ResourceInterface::FIELD_STORE_PICKUP, $storePickup);
        }

        /**
         * @inheritdoc
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
         * @inheritdoc
         */
        public function setPickupWindow(?OrderPickupWindowInterface $pickupWindow): self
        {
            $this->setData(ResourceInterface::FIELD_PICKUP_WINDOW_ID, $pickupWindow ? $pickupWindow->getId() : null);
            return $this->setData(static::FIELD_PICKUP_WINDOW, $pickupWindow);
        }

        /**
         * @inheritdoc
         */
        public function getPickupAddress(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_PICKUP_ADDRESS);
        }

        /**
         * @inheritdoc
         */
        public function setPickupAddress(?string $pickupAddress): self
        {
            return $this->setData(ResourceInterface::FIELD_PICKUP_ADDRESS, $pickupAddress);
        }

        /**
         * @inheritdoc
         */
        public function getNumberOfParcels(): ?int
        {
            return (int) $this->getData(ResourceInterface::FIELD_NUMBER_OF_PARCELS);
        }

        /**
         * @inheritdoc
         */
        public function setNumberOfParcels(?int $numberOfParcels): self
        {
            return $this->setData(ResourceInterface::FIELD_NUMBER_OF_PARCELS, (string) $numberOfParcels);
        }

        /**
         * Customer Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface $customerRepository
         */
        private $customerRepository;

        /**
         * Gets Customer Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface
         */
        protected function getCustomerRepository(): CustomerRepositoryInterface
        {
            return $this->customerRepository;
        }

        /**
         * Invoice Details property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface $invoiceDetailsRepository
         */
        private $invoiceDetailsRepository;

        /**
         * Gets Invoice Details
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface
         */
        protected function getInvoiceDetailsRepository(): InvoiceDetailsRepositoryInterface
        {
            return $this->invoiceDetailsRepository;
        }

        /**
         * Line Item Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface $lineItemRepository
         */
        private $lineItemRepository;

        /**
         * Gets Line Item Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface
         */
        protected function getLineItemRepository(): LineItemRepositoryInterface
        {
            return $this->lineItemRepository;
        }

        /**
         * Accept Options Repository property
         *
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
         */
        private $acceptOptionsRepository;

        /**
         * Gets Accept Options Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface
         */
        protected function getAcceptOptionsRepository(): AcceptOptionsRepositoryInterface
        {
            return $this->acceptOptionsRepository;
        }

        /**
         * Reject Options Repository property
         *
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface $rejectOptionsRepository
         */
        private $rejectOptionsRepository;

        /**
         * Gets Reject Options Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface
         */
        protected function getRejectOptionsRepository(): RejectOptionsRepositoryInterface
        {
            return $this->rejectOptionsRepository;
        }

        /**
         * Magento Order Repository property
         *
         * @access private
         *
         * @var \Magento\Sales\Api\OrderRepositoryInterface $magentoOrderRepository
         */
        private $magentoOrderRepository;

        /**
         * Gets Magento Order Repository
         *
         * @access protected
         *
         * @return \Magento\Sales\Api\OrderRepositoryInterface
         */
        protected function getMagentoOrderRepository(): MagentoOrderRepositoryInterface
        {
            return $this->magentoOrderRepository;
        }

        /**
         * Search Criteria Builder property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        private $searchCriteriaBuilder;

        /**
         * Gets Search Criteria Builder
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected function getSearchCriteriaBuilder(): SearchCriteriaBuilder
        {
            return $this->searchCriteriaBuilder;
        }
    }
?>