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
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\LineItem as ResourceModel;

    class LineItemRepository
    implements LineItemRepositoryInterface
    {
        protected
            $_idCache = [],
            $_skroutzIdCache = [];

        public function __construct(
            ResourceModel $resourceModel,
            LineItemInterfaceFactory $lineItemFactory,
            CollectionProcessorInterface $collectionProcessor
        )
        {
            $this->_resourceModel = $resourceModel;
            $this->_lineItemFactory = $lineItemFactory;
            $this->_collectionProcessor = $collectionProcessor;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : LineItemInterface
        {
            $lineItem = $this->_idCache[$id] ?? null;
            if(!$lineItem) {
                $lineItem = $this->getLineItemFactory()->create();
                $this->getResourceModel()->load($lineItem, $id, ResourceModel::FIELD_LOCAL_ID);
                $id = $lineItem->getId();
                if (!$id)
                {
                    throw new NoSuchEntityException(
                        __('The lineItem with id "%1" that was requested doesn\'t exist. Verify the lineItem and try again.', $id)
                    );
                }
                $this->_idCache[$id]                      = $lineItem;
                $this->_idCache[ $lineItem->getSkroutzId() ]   = $lineItem;
            }
            return $lineItem;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(string $skroutzId) : LineItemInterface
        {
            $lineItem = $this->_skroutzIdCache[$skroutzId] ?? null;
            if(!$lineItem) {
                $lineItem = $this->getLineItemFactory()->create();
                $this->getResourceModel()->load($lineItem, $skroutzId, ResourceModel::FIELD_SKROUTZ_ID);
                $id = $lineItem->getId();
                if (!$id)
                {
                    throw new NoSuchEntityException(
                        __('The Line Item with id "%1" that was requested doesn\'t exist. Verify the lineItem and try again.', $id)
                    );
                }
                $this->_skroutzIdCache[$skroutzId]  = $lineItem;
                $this->_idCache[$id]      = $lineItem;
            }
            return $lineItem;
        }

        /**
         * @inheritdoc
         */
        public function getList(SearchCriteriaInterface $searchCriteria)
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
            $this->getResourceModel()->save($lineItem);
            $this->_idCache[ $lineItem->getId() ]     = $lineItem;
            $this->_skroutzIdCache[ $lineItem->getSkroutzId() ] = $lineItem;
            return $lineItem;
        }

        /**
         * @inheritdoc
         */
        public function delete(LineItemInterface $lineItem) : bool
        {
            $this->getResourceModel()->delete($lineItem);
            unset( $this->_idCache[ $lineItem->getId() ] );
            unset( $this->_skroutzIdCache[ $lineItem->getSkroutzId() ] );
            return $lineItem->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_lineItemFactory;
        protected function getLineItemFactory() : LineItemInterfaceFactory
        {
            return $this->_lineItemFactory;
        }

        private $_collectionProcessor;
        protected function getCollectionProcessor() : CollectionProcessorInterface
        {
            return $this->_collectionProcessor;
        }
    }
?>