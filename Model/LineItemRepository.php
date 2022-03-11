<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,

        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\LineItemRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\LineItem as ResourceModel;

    class LineItemRepository
    implements LineItemRepositoryInterface
    {
        protected
            $_localIdIndex      = [],
            $_skroutzIdIndex    = [];

        public function __construct(
            ResourceModel $resourceModel,
            LineItemInterfaceFactory $lineItemFactory,
            CollectionProcessorInterface $collectionProcessor
        )
        {
            $this->_resourceModel       = $resourceModel;
            $this->_lineItemFactory     = $lineItemFactory;
            $this->_collectionProcessor = $collectionProcessor;
        }

        /**
         * @inheritdoc
         */
        public function getByLocalId(int $localId) : LineItemInterface
        {
            $lineItem = $this->_localIdIndex[$localId] ?? null;
            if(!$lineItem) {
                $lineItem = $this->getLineItemFactory()->create();
                $this->getResourceModel()->load($lineItem, $localId, ResourceModel::FIELD_LOCAL_ID);
                $localId = $lineItem->getLocalId();
                if (!$localId)
                {
                    throw new NoSuchEntityException(
                        __('The lineItem with id "%1" that was requested doesn\'t exist. Verify the lineItem and try again.', $localId)
                    );
                }
                $this->_localIdIndex[$localId]                      = $lineItem;
                $this->_localIdIndex[ $lineItem->getSkroutzId() ]   = $lineItem;
            }
            return $lineItem;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(string $skroutzId) : LineItemInterface
        {
            $lineItem = $this->_skroutzIdIndex[$skroutzId] ?? null;
            if(!$lineItem) {
                $lineItem = $this->getLineItemFactory()->create();
                $this->getResourceModel()->load($lineItem, $skroutzId, ResourceModel::FIELD_SKROUTZ_ID);
                $localId = $lineItem->getLocalId();
                if (!$localId)
                {
                    throw new NoSuchEntityException(
                        __('The Line Item with id "%1" that was requested doesn\'t exist. Verify the lineItem and try again.', $localId)
                    );
                }
                $this->_skroutzIdIndex[$skroutzId]  = $lineItem;
                $this->_localIdIndex[$localId]      = $lineItem;
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
            $this->_localIdIndex[ $lineItem->getLocalId() ]     = $lineItem;
            $this->_skroutzIdIndex[ $lineItem->getSkroutzId() ] = $lineItem;
            return $lineItem;
        }

        /**
         * @inheritdoc
         */
        public function delete(LineItemInterface $lineItem) : bool
        {
            $this->getResourceModel()->delete($lineItem);
            unset( $this->_localIdIndex[ $lineItem->getLocalId() ] );
            unset( $this->_skroutzIdIndex[ $lineItem->getSkroutzId() ] );
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