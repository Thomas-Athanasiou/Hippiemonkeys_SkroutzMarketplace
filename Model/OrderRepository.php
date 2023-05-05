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

    use Magento\Framework\Api\SearchCriteriaInterface,
        Magento\Framework\Api\SearchCriteriaBuilder,
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,
        Magento\Sales\Api\Data\OrderInterface as MagentoOrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterfaceFactory as SearchsReultInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface as ResourceInterface;

    class OrderRepository
    implements OrderRepositoryInterface
    {
        protected
            /**
             * Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $_idCache
             */
            $_idCache = [],

            /**
             * Magento Order Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $_magentoOrderCache
             */
            $_magentoOrderCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface $resource
         * @param \Hippiemonkeys\Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory $orderFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterfaceFactory $searchResultFactory,
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        public function __construct(
            ResourceInterface $resource,
            OrderInterfaceFactory $orderFactory,
            CollectionProcessorInterface $collectionProcessor,
            SearchsReultInterfaceFactory $searchResultFactory,
            SearchCriteriaBuilder $searchCriteriaBuilder
        )
        {
            $this->_resource = $resource;
            $this->_orderFactory = $orderFactory;
            $this->_collectionProcessor = $collectionProcessor;
            $this->_searchResultFactory = $searchResultFactory;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * {@inheritdoc}
         */
        public function getByCode(string $code) : OrderInterface
        {
            $order = $this->getOrderFactory()->create();
            $this->getResource()->loadOrderByCode($order, $code);

            $id = $order->getId();
            if (!$id)
            {
                throw new NoSuchEntityException(
                    __('The order with code "%1" that was requested doesn\'t exist. Verify the order and try again.', $code)
                );
            }
            else
            {
                $magentoOrder = $order->getMagentoOrder();
                if($magentoOrder !== null)
                {
                    $this->_magentoOrderCache[$magentoOrder->getId()] = $order;
                }

                $this->_idCache[$id] = $order;
            }

            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : OrderInterface
        {
            $order = $this->_idCache[$id] ?? null;
            if($order === null)
            {
                $order = $this->getOrderFactory()->create();
                $this->getResource()->loadOrderById($order, $id);
                if (!$order->getId())
                {
                    throw new NoSuchEntityException(
                        __('The order with id "%1" that was requested doesn\'t exist. Verify the order and try again.', $id)
                    );
                }
                else
                {
                    $magentoOrder = $order->getMagentoOrder();
                    if($magentoOrder !== null)
                    {
                        $this->_magentoOrderCache[$magentoOrder->getId()] = $magentoOrder;
                    }

                    $this->_idCache[$id] = $order;
                }
            }

            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function getByMagentoOrder(MagentoOrderInterface $magentoOrder) : OrderInterface
        {
            $magentoOrderId = $magentoOrder->getEntityId();
            $order = $this->_magentoOrderCache[$magentoOrderId] ?? null;
            if($order === null)
            {
                $order = $this->getOrderFactory()->create();
                $this->getResource()->loadOrderByMagentoOrderId($order, $magentoOrderId);
                $id = $order->getId();

                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Order with Magento Order Id "%1" that was requested doesn\'t exist. Verify the Order and try again.', $magentoOrderId)
                    );
                }
                else
                {
                    $this->_magentoOrderCache[$magentoOrderId]  = $magentoOrderId;
                    $this->_idCache[$id] = $order;
                }
            }
            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * {@inheritdoc}
         */
        public function save(OrderInterface $order) : OrderInterface
        {
            $this->_idCache[ $order->getId() ] = $order;
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder !== null)
            {
                $this->_magentoOrderCache[$magentoOrder->getEntityId()] = $order;
            }
            $this->getResource()->saveOrder($order);
            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(OrderInterface $order) : bool
        {
            unset( $this->_idCache[ $order->getId() ] );
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder !== null)
            {
                unset($this->_magentoOrderCache[$magentoOrder->getEntityId()]);
            }
            return $this->getResource()->deleteOrder($order);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Order Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory $_orderFactory
         */
        private $_orderFactory;

        /**
         * Gets Order Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory
         */
        protected function getOrderFactory(): OrderInterfaceFactory
        {
            return $this->_orderFactory;
        }

        /**
         * Collection Processor property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $_collectionProcessor
         */
        private $_collectionProcessor;

        /**
         * Gets Collection Processor
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
         */
        protected function getCollectionProcessor() : CollectionProcessorInterface
        {
            return $this->_collectionProcessor;
        }

        /**
         * Search Result Factory property
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterfaceFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory()
        {
            return $this->_searchResultFactory;
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