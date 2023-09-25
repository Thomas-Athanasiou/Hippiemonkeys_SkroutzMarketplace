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
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemSearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface as ResourceInterface;

    class LineItemRepository
    implements LineItemRepositoryInterface
    {
        protected
            /**
             * Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface[] $idCache
             */
            $idCache = [],

            /**
             * Skroutz Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface[] $skroutzIdCache
             */
            $skroutzIdCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterfaceFactory $factory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemSearchResultInterfaceFactory $searchResultFactory
         */
        public function __construct(
            ResourceInterface $resource,
            LineItemInterfaceFactory $factory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResultFactory
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
            $this->collectionProcessor = $collectionProcessor;
            $this->searchResultFactory = $searchResultFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : LineItemInterface
        {
            $lineItem = $this->idCache[$id] ?? null;
            if($lineItem === null)
            {
                $lineItem = $this->getFactory()->create();
                $this->getResource()->loadLineItemById($lineItem, $id);
                if ($lineItem->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The lineItem with id "%1" that was requested doesn\'t exist. Verify the lineItem and try again.', $id)
                    );
                }
                else
                {
                    $this->idCache[$id] = $lineItem;
                    $this->skroutzIdCache[$lineItem->getSkroutzId()] = $lineItem;
                }
            }
            return $lineItem;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(string $skroutzId) : LineItemInterface
        {
            $lineItem = $this->skroutzIdCache[$skroutzId] ?? null;
            if($lineItem === null)
            {
                $lineItem = $this->getFactory()->create();
                $this->getResource()->loadLineItemBySkroutzId($lineItem, $skroutzId);
                $id = $lineItem->getId();
                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Line Item with id "%1" that was requested doesn\'t exist. Verify the lineItem and try again.', $id)
                    );
                }
                else
                {
                    $this->skroutzIdCache[$skroutzId] = $lineItem;
                    $this->idCache[$id] = $lineItem;
                }
            }
            return $lineItem;
        }

        /**
         * @inheritdoc
         */
        public function getList(SearchCriteriaInterface $searchCriteria): LineItemSearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * @inheritdoc
         */
        public function save(LineItemInterface $lineItem) : LineItemInterface
        {
            $this->getResource()->saveLineItem($lineItem);
            $this->idCache[$lineItem->getId()] = $lineItem;
            $this->skroutzIdCache[$lineItem->getSkroutzId()] = $lineItem;
            return $lineItem;
        }

        /**
         * @inheritdoc
         */
        public function delete(LineItemInterface $lineItem) : bool
        {
            unset($this->idCache[$lineItem->getId()]);
            unset($this->skroutzIdCache[$lineItem->getSkroutzId()]);
            return $this->getResource()->deleteLineItem($lineItem);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface
         */
        protected final function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Line Item Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Line Item Factory
         *
         * @access protected
         * @final
         *
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterfaceFactory
         */
        protected final function getFactory() : LineItemInterfaceFactory
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
         * @final
         *
         * @return \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
         */
        protected final function getCollectionProcessor() : CollectionProcessorInterface
        {
            return $this->collectionProcessor;
        }

        /**
         * Search Result Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemSearchResultInterfaceFactory $searchResultFactory
         */
        private $searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemSearchResultInterfaceFactory
         */
        protected final function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->searchResultFactory;
        }
    }
?>