<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,

        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptionsPickupWindowRelation as ResourceModel,

        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsPickupWindowRelationRepositoryInterface;

    class AcceptOptionsPickupWindowRelationRepository
    implements AcceptOptionsPickupWindowRelationRepositoryInterface
    {
        protected $_idIndex = [];

        public function __construct(
            ResourceModel $resourceModel,
            AcceptOptionsPickupWindowRelationInterfaceFactory $acceptOptionsPickupWindowRelationFactory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResulFactory
        )
        {
            $this->_resourceModel                               = $resourceModel;
            $this->_acceptOptionsPickupWindowRelationFactory  = $acceptOptionsPickupWindowRelationFactory;
            $this->_collectionProcessor                         = $collectionProcessor;
            $this->_searchResultFactory                         = $searchResulFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : AcceptOptionsPickupWindowRelationInterface
        {
            $acceptOptionsPickupWindowRelation = $this->_idIndex[$id] ?? null;
            if(!$acceptOptionsPickupWindowRelation) {
                $acceptOptionsPickupWindowRelation = $this->getAcceptOptionsPickupWindowRelationFactory()->create();
                $this->getResourceModel()->load($acceptOptionsPickupWindowRelation, $id, ResourceModel::FIELD_ID);
                if (!$acceptOptionsPickupWindowRelation->getId())
                {
                    throw new NoSuchEntityException(
                        __('The relation with id "%1" that was requested doesn\'t exist. Verify the relation and try again.', $id)
                    );
                }
                $this->_idIndex[$id] = $acceptOptionsPickupWindowRelation;
            }
            return $acceptOptionsPickupWindowRelation;
        }

        /**
         * @inheritdoc
         */
        public function getByAcceptOptionsAndPickupWindow(
            AcceptOptionsInterface $acceptOptions,
            PickupWindowInterface $pickupWindow
        ) : AcceptOptionsPickupWindowRelationInterface
        {
            $acceptOptionsPickupWindowRelation = $this->getAcceptOptionsPickupWindowRelationFactory()->create();

            $acceptOptionsId        = $acceptOptions->getId();
            $pickupWindowLocalId    = $pickupWindow->getLocalId();
            $this->getResourceModel()->loadByAcceptOptionsIdAndPickupWindow(
                $acceptOptionsPickupWindowRelation,
                $acceptOptionsId,
                $pickupWindowLocalId
            );
            $id = $acceptOptionsPickupWindowRelation->getId();
            if (!$id)
            {
                throw new NoSuchEntityException(
                    __(
                        'The relation with Accept Options ID "%1" and Pickup Window ID "%2" that was requested doesn\'t exist. Verify the relation and try again.',
                        $acceptOptionsId,
                        $pickupWindowLocalId
                    )
                );
            }
            $this->_idIndex[$id] = $acceptOptionsPickupWindowRelation;
            return $acceptOptionsPickupWindowRelation;
        }


        /**
         * @inheritdoc
         */
        public function getList(SearchCriteriaInterface $searchCriteria): AcceptOptionsPickupWindowRelationSearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * @inheritdoc
         */
        public function save(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation) : AcceptOptionsPickupWindowRelationInterface
        {
            $this->getResourceModel()->save($acceptOptionsPickupWindowRelation);
            $this->_idIndex[ $acceptOptionsPickupWindowRelation->getId() ] = $acceptOptionsPickupWindowRelation;
            return $acceptOptionsPickupWindowRelation;
        }

        /**
         * @inheritdoc
         */
        public function delete(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation) : bool
        {
            return $this->getResourceModel()->delete($acceptOptionsPickupWindowRelation);
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_acceptOptionsPickupWindowRelationFactory;
        protected function getAcceptOptionsPickupWindowRelationFactory() : AcceptOptionsPickupWindowRelationInterfaceFactory
        {
            return $this->_acceptOptionsPickupWindowRelationFactory;
        }

        private $_collectionProcessor;
        protected function getCollectionProcessor() : CollectionProcessorInterface
        {
            return $this->_collectionProcessor;
        }

        private $_searchResultFactory;
        protected function getSearchResultFactory()
        {
            return $this->_searchResultFactory;
        }
    }
?>