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

    use Magento\Framework\Api\SearchCriteriaInterface,
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,

        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterfaceFactory,
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
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface[] $_idCache
             */
            $_idCache = [],

            /**
             * Skroutz Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface[] $_skroutzIdCache
             */
            $_skroutzIdCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterfaceFactory $lineItemFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        public function __construct(
            ResourceInterface $resource,
            LineItemInterfaceFactory $lineItemFactory,
            CollectionProcessorInterface $collectionProcessor
        )
        {
            $this->_resource = $resource;
            $this->_lineItemFactory = $lineItemFactory;
            $this->_collectionProcessor = $collectionProcessor;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : LineItemInterface
        {
            $lineItem = $this->_idCache[$id] ?? null;
            if($lineItem === null)
            {
                $lineItem = $this->getLineItemFactory()->create();
                $this->getResource()->loadLineItemById($lineItem, $id);
                if ($lineItem->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The lineItem with id "%1" that was requested doesn\'t exist. Verify the lineItem and try again.', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $lineItem;
                    $this->_idCache[$lineItem->getSkroutzId()] = $lineItem;
                }
            }
            return $lineItem;
        }

        /**
         * {@inheritdoc}
         */
        public function getBySkroutzId(string $skroutzId) : LineItemInterface
        {
            $lineItem = $this->_skroutzIdCache[$skroutzId] ?? null;
            if($lineItem === null)
            {
                $lineItem = $this->getLineItemFactory()->create();
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
                    $this->_skroutzIdCache[$skroutzId] = $lineItem;
                    $this->_idCache[$id] = $lineItem;
                }
            }
            return $lineItem;
        }

        /**
         * {@inheritdoc}
         */
        public function getList(SearchCriteriaInterface $searchCriteria)
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * {@inheritdoc}
         */
        public function save(LineItemInterface $lineItem) : LineItemInterface
        {
            $this->getResource()->saveLineItem($lineItem);
            $this->_idCache[$lineItem->getId()] = $lineItem;
            $this->_skroutzIdCache[$lineItem->getSkroutzId()] = $lineItem;
            return $lineItem;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(LineItemInterface $lineItem) : bool
        {
            unset($this->_idCache[$lineItem->getId()]);
            unset($this->_skroutzIdCache[$lineItem->getSkroutzId()]);
            return $this->getResource()->deleteLineItem($lineItem);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Line Item Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterfaceFactory $_lineItemFactory
         */
        private $_lineItemFactory;

        /**
         * Gets Line Item Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterfaceFactory
         */
        protected function getLineItemFactory() : LineItemInterfaceFactory
        {
            return $this->_lineItemFactory;
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
    }
?>