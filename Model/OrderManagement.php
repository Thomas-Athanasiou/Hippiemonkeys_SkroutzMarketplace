<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package HippiemonkeysskroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Api\SearchCriteriaBuilder,
        Magento\Framework\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderManagementInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsManagementInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\CustomerManagementInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderProcessorInterface;

    class OrderManagement
    implements OrderManagementInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderProcessorInterface $orderProcessor
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface $skroutzMarketplace
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsManagementInterface $invoiceDetailsManagement
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\CustomerManagementInterface $customerManagement
         */
        public function __construct(
            OrderProcessorInterface $orderProcessor,
            OrderRepositoryInterface $orderRepository,
            SearchCriteriaBuilder $searchCriteriaBuilder,
            SkroutzMarketplaceInterface $skroutzMarketplace,
            InvoiceDetailsManagementInterface $invoiceDetailsManagement,
            CustomerManagementInterface $customerManagement
        )
        {
            $this->orderProcessor = $orderProcessor;
            $this->orderRepository = $orderRepository;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;
            $this->skroutzMarketplace = $skroutzMarketplace;
            $this->invoiceDetailsManagement = $invoiceDetailsManagement;
            $this->customerManagement = $customerManagement;
        }

        /**
         * @inheritdoc
         */
        public function processOrder(OrderInterface $order): void
        {
            $this->syncOrder($order);
            $this->getOrderProcessor()->processOrder($order);
            $this->getOrderRepository()->save($order);
        }

        /**
         * @inheritdoc
         */
        public function updateAndProcessOrder(OrderInterface $order): void
        {
            $this->processOrder(
                $this->getSkroutzMarketplace()->getOrder(
                    $order->getCode()
                )
            );
        }

        /**
         * @inheritdoc
         */
        public function updateAndProcessOrdersWithState(string $state): void
        {
            $this->updateAndProcessOrderList(
                $this->getOrderRepository()->getList(
                    $this->getSearchCriteriaBuilder()
                        ->addFilter(OrderResourceInterface::FIELD_STATE, $state, 'eq')
                        ->setPageSize(null)
                        ->create()
                )
            );
        }

        /**
         * @inheritdoc
         */
        public function updateAndProcessOrdersWithStateAndLimit(string $state, int $limit): void
        {
            $this->updateAndProcessOrderList(
                $this->getOrderRepository()->getList(
                    $this->getSearchCriteriaBuilder()
                        ->addFilter(OrderResourceInterface::FIELD_STATE, $state, 'eq')
                        ->setPageSize($limit)
                        ->create()
                )
            );
        }

        /**
         * @inheritdoc
         */
        public function saveOrder(OrderInterface $order): void
        {
            $this->syncOrder($order);
            $this->getOrderRepository()->save($order);
        }

        /**
         * @inheritdoc
         */
        public function syncOrder(OrderInterface $order): void
        {
            $invoiceDetails = $order->getInvoiceDetails();

            try
            {
                $persistentOrder = $this->getOrderRepository()->getByCode($order->getCode());

                $order->setId($persistentOrder->getId());
                $order->setMagentoOrder($persistentOrder->getMagentoOrder());

                $persistentInvoiceDetails = $persistentOrder->getInvoiceDetails();
                if($persistentInvoiceDetails !== null && $invoiceDetails !== null)
                {
                    $invoiceDetails->setId($persistentInvoiceDetails->getId());

                    $address = $invoiceDetails->getAddress();
                    $persistentAddress = $persistentInvoiceDetails->getAddress();
                    if($persistentAddress !== null && $address !== null)
                    {
                        $address->setId($persistentAddress->getId());
                    }

                    $invoiceDetails->setAddress($address);
                }
            }
            catch(NoSuchEntityException)
            {
                /** Order doesn't exist in the first place */
            }

            if($invoiceDetails !== null)
            {
                $this->getInvoiceDetailsManagement()->saveInvoiceDetails($invoiceDetails);
                $order->setInvoiceDetails($invoiceDetails);
            }

            $customer = $order->getCustomer();
            if($customer !== null)
            {
                $this->getCustomerManagement()->saveCustomer($customer);
                $order->setCustomer($customer);
            }
        }

        /**
         * Updates and processes order list
         *
         * @access protected
         * @final
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderSearchResultInterface $orderSearchResult
         */
        protected final function updateAndProcessOrderList(OrderSearchResultInterface $orderSearchResult): void
        {
            foreach ($orderSearchResult->getItems() as $order)
            {
                $this->updateAndProcessOrder($order);
            }
        }

        /**
         * Order Processor property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderProcessorInterface
         */
        private $orderProcessor;

        /**
         * Order Processor
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderProcessorInterface
         */
        protected final function getOrderProcessor(): OrderProcessorInterface
        {
            return $this->orderProcessor;
        }

        /**
         * Order Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        private $orderRepository;

        /**
         * Gets Order Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        protected final function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->orderRepository;
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
         * @final
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected final function getSearchCriteriaBuilder() : SearchCriteriaBuilder
        {
            return $this->searchCriteriaBuilder;
        }

        /**
         * Skroutz Marketplace property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface $skroutzMarketplace
         */
        private $skroutzMarketplace;

        /**
         * Gets Skroutz Marketplace
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface
         */
        protected final function getSkroutzMarketplace() : SkroutzMarketplaceInterface
        {
            return $this->skroutzMarketplace;
        }

        /**
         * Invoice Details Management property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsManagementInterface $invoiceDetailsManagement
         */
        private $invoiceDetailsManagement;

        /**
         * Gets Invoice Details Management
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsManagementInterface
         */
        protected final function getInvoiceDetailsManagement() : InvoiceDetailsManagementInterface
        {
            return $this->invoiceDetailsManagement;
        }

        /**
         * Customer Management property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\CustomerManagementInterface $customerManagement
         */
        private $customerManagement;

        /**
         * Gets Customer Management
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\CustomerManagementInterface
         */
        protected final function getCustomerManagement() : CustomerManagementInterface
        {
            return $this->customerManagement;
        }
    }
?>