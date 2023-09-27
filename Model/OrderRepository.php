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
        Magento\Framework\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterfaceFactory as SearchResultInterfaceFactory,
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
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $idCache
             */
            $idCache = [],

            /**
             * Magento Order Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $magentoOrderCache
             */
            $magentoOrderCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface $resource
         * @param \Hippiemonkeys\Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory $factory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterfaceFactory $searchResultFactory,
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        public function __construct(
            ResourceInterface $resource,
            OrderInterfaceFactory $factory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResultFactory,
            SearchCriteriaBuilder $searchCriteriaBuilder
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
            $this->collectionProcessor = $collectionProcessor;
            $this->searchResultFactory = $searchResultFactory;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * @inheritdoc
         */
        public function getByCode(string $code) : OrderInterface
        {
            $order = $this->getFactory()->create();
            $this->getResource()->loadOrderByCode($order, $code);

            $id = $order->getId();
            if ($id === null)
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
                    $this->magentoOrderCache[$magentoOrder->getId()] = $order;
                }

                $this->idCache[$id] = $order;
            }

            return $order;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : OrderInterface
        {
            $order = $this->idCache[$id] ?? null;
            if($order === null)
            {
                $order = $this->getFactory()->create();
                $this->getResource()->loadOrderById($order, $id);
                if ($order->getId() === null)
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
                        $this->magentoOrderCache[$magentoOrder->getId()] = $magentoOrder;
                    }

                    $this->idCache[$id] = $order;
                }
            }

            return $order;
        }

        /**
         * @inheritdoc
         */
        public function getByMagentoOrder(MagentoOrderInterface $magentoOrder) : OrderInterface
        {
            $magentoOrderId = $magentoOrder->getEntityId();
            $order = $this->magentoOrderCache[$magentoOrderId] ?? null;
            if($order === null)
            {
                $order = $this->getFactory()->create();
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
                    $this->magentoOrderCache[$magentoOrderId]  = $magentoOrderId;
                    $this->idCache[$id] = $order;
                }
            }
            return $order;
        }

        /**
         * @inheritdoc
         */
        public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * @inheritdoc
         */
        public function save(OrderInterface $order) : OrderInterface
        {
            $this->idCache[$order->getId()] = $order;
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder !== null)
            {
                $this->magentoOrderCache[$magentoOrder->getEntityId()] = $order;
            }
            $this->getResource()->saveOrder($order);
            return $order;
        }

        /**
         * @inheritdoc
         */
        public function delete(OrderInterface $order) : bool
        {
            unset($this->idCache[$order->getId()]);
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder !== null)
            {
                unset($this->magentoOrderCache[$magentoOrder->getEntityId()]);
            }
            return $this->getResource()->deleteOrder($order);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory
         */
        protected function getFactory(): OrderInterfaceFactory
        {
            return $this->factory;
        }

        /**
         * Collection Processor property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        private $collectionProcessor;

        /**
         * Gets Collection Processor
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
         */
        protected function getCollectionProcessor() : CollectionProcessorInterface
        {
            return $this->collectionProcessor;
        }

        /**
         * Search Result Factory property
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterfaceFactory $searchResultFactory
         */
        private $searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->searchResultFactory;
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
        protected function getSearchCriteriaBuilder() : SearchCriteriaBuilder
        {
            return $this->searchCriteriaBuilder;
        }
    }
?>