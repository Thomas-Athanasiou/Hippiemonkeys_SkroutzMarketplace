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
        Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderManagementInterface,
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
         */
        public function __construct(
            OrderProcessorInterface $orderProcessor,
            OrderRepositoryInterface $orderRepository,
            SearchCriteriaBuilder $searchCriteriaBuilder,
            SkroutzMarketplaceInterface $skroutzMarketplace
        )
        {
            $this->_orderProcessor = $orderProcessor;
            $this->_orderRepository = $orderRepository;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
            $this->_skroutzMarketplace = $skroutzMarketplace;
        }

        /**
         * {@inheritdoc}
         */
        public function processOrder(OrderInterface $order): void
        {
            $this->getOrderProcessor()->processOrder($order);
        }

        /**
         * {@inheritdoc}
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
         * {@inheritdoc}
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
         * {@inheritdoc}
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
         * Updates and processes order list
         *
         * @access protected
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderSearchResultInterface $orderSearchResult
         */
        protected function updateAndProcessOrderList(OrderSearchResultInterface $orderSearchResult): void
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
        private $_orderProcessor;

        /**
         * Order Processor
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderProcessorInterface
         */
        protected function getOrderProcessor(): OrderProcessorInterface
        {
            return $this->_orderProcessor;
        }

        /**
         * Order Repository property
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
        protected function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->_orderRepository;
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
        protected function getSearchCriteriaBuilder() : SearchCriteriaBuilder
        {
            return $this->_searchCriteriaBuilder;
        }

        /**
         * Skroutz Marketplace property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface $_searchCriteriaBuilder
         */
        private $_skroutzMarketplace;

        /**
         * Gets Skroutz Marketplace
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface
         */
        protected function getSkroutzMarketplace() : SkroutzMarketplaceInterface
        {
            return $this->_skroutzMarketplace;
        }
    }
?>