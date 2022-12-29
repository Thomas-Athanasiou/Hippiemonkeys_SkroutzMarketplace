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
         */
        public function __construct(
            OrderProcessorInterface $orderProcessor,
            OrderRepositoryInterface $orderRepository,
            SearchCriteriaBuilder $searchCriteriaBuilder
        )
        {
            $this->_orderProcessor = $orderProcessor;
            $this->_orderRepository = $orderRepository;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
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
        public function updateAndProcessOrdersWithState(string $state): void
        {
            $this->updateAndProcessOrderList(
                $this->getOrderRepository()->getList(
                    $this->getSearchCriteriaBuilder()
                        ->addFilter(OrderResourceInterface::FIELD_STATE, $state, 'eq')
                        ->setPageSize(null)
                        ->create()
                )
                ->getItems()
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
                ->getItems()
            );
        }

        protected function updateAndProcessOrderList(OrderSearchResultInterface $orderSearchResult)
        {
            foreach ($persistentOrders as $persistentOrder)
            {
                $this->processOrder(
                    $this->getSkroutzMa
                );
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
    }
?>