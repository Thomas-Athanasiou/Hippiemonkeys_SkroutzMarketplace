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
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,
        Magento\Framework\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderPickupWindowRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderPickupWindowResourceInterface as ResourceInterface;

    class OrderPickupWindowRepository
    implements OrderPickupWindowRepositoryInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderPickupWindowResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterfaceFactory $factory
         * @param \Hippiemonkeys\ShippingTrack\Api\Data\PickupLocationSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        public function __construct(
            ResourceInterface $resource,
            OrderPickupWindowInterfaceFactory $factory,
            SearchResultInterfaceFactory $searchResultFactory,
            CollectionProcessorInterface $collectionProcessor,
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
            $this->searchResultFactory = $searchResultFactory;
            $this->collectionProcessor = $collectionProcessor;
        }

        /**
         * Id Cache property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface[] $idCache
         */
        protected $idCache = [];

        /**
         * @inheritdoc
         */
        public function getById($id) : OrderPickupWindowInterface
        {
            $orderPickupWindow = $this->idCache[$id] ?? null;
            if($orderPickupWindow === null)
            {
                $orderPickupWindow = $this->getFactory()->create();
                $this->getResource()->loadOrderPickupWindowById($orderPickupWindow, $id, ResourceInterface::FIELD_ID);
                if ($orderPickupWindow->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Vat Exclusion Representative with id "%1" that was requested doesn\'t exist. Verify the Vat Exclusion Representative and try again.', $id)
                    );
                }
                else
                {
                    $this->idCache[$id] = $orderPickupWindow;
                }
            }

            return $orderPickupWindow;
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
        public function save(OrderPickupWindowInterface $orderPickupWindow) : OrderPickupWindowInterface
        {
            $this->getResource()->saveOrderPickupWindow($orderPickupWindow);
            $this->idCache[$orderPickupWindow->getId()] = $orderPickupWindow;
            return $orderPickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function delete(OrderPickupWindowInterface $orderPickupWindow) : bool
        {
            unset($this->idCache[$orderPickupWindow->getId()]);
            return $this->getResource()->deleteOrderPickupWindow($orderPickupWindow);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderPickupWindowResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderPickupWindowResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Pickup Window Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Pickup Window Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterfaceFactory
         */
        protected function getFactory() : OrderPickupWindowInterfaceFactory
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
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowSearchResultInterfaceFactory $searchResultFactory
         */
        private $searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->searchResultFactory;
        }
    }
?>