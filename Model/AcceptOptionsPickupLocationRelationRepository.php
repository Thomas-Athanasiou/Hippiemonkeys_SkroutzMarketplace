<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,

        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptionsPickupLocationRelation as ResourceModel,

        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsPickupLocationRelationRepositoryInterface;

    class AcceptOptionsPickupLocationRelationRepository
    implements AcceptOptionsPickupLocationRelationRepositoryInterface
    {
        protected $_idIndex = [];

        public function __construct(
            ResourceModel $resourceModel,
            AcceptOptionsPickupLocationRelationInterfaceFactory $acceptOptionsPickupLocationRelationFactory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResulFactory
        )
        {
            $this->_resourceModel                               = $resourceModel;
            $this->_acceptOptionsPickupLocationRelationFactory  = $acceptOptionsPickupLocationRelationFactory;
            $this->_collectionProcessor                         = $collectionProcessor;
            $this->_searchResultFactory                         = $searchResulFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById(int $id) : AcceptOptionsPickupLocationRelationInterface
        {
            $acceptOptionsPickupLocationRelation = $this->_idIndex[$id] ?? null;
            if(!$acceptOptionsPickupLocationRelation) {
                $acceptOptionsPickupLocationRelation = $this->getAcceptOptionsPickupLocationRelationFactory()->create();
                $this->getResourceModel()->load($acceptOptionsPickupLocationRelation, $id, ResourceModel::FIELD_ID);
                if (!$acceptOptionsPickupLocationRelation->getId())
                {
                    throw new NoSuchEntityException(
                        __('The relation with id "%1" that was requested doesn\'t exist. Verify the relation and try again.', $id)
                    );
                }
                $this->_idIndex[$id] = $acceptOptionsPickupLocationRelation;
            }
            return $acceptOptionsPickupLocationRelation;
        }

        /**
         * @inheritdoc
         */
        public function getByAcceptOptionsAndPickupLocation(
            AcceptOptionsInterface $acceptOptions,
            PickupLocationInterface $pickupLocation
        ) : AcceptOptionsPickupLocationRelationInterface
        {
            $acceptOptionsPickupLocationRelation = $this->getAcceptOptionsPickupLocationRelationFactory()->create();
            $acceptOptionsId        = $acceptOptions->getId();
            $pickupLocationLocalId  = $pickupLocation->getLocalId();
            $this->getResourceModel()->loadByAcceptOptionsIdAndPickupLocation(
                $acceptOptionsPickupLocationRelation,
                $acceptOptionsId,
                $pickupLocationLocalId
            );
            $id = $acceptOptionsPickupLocationRelation->getId();
            if (!$id)
            {
                throw new NoSuchEntityException(
                    __(
                        'The relation with Accept Options ID "%1" and Pickup Location ID "%2" that was requested doesn\'t exist. Verify the relation and try again.',
                        $acceptOptionsId,
                        $pickupLocationLocalId
                    )
                );
            }
            $this->_idIndex[$id] = $acceptOptionsPickupLocationRelation;
            return $acceptOptionsPickupLocationRelation;
        }


        /**
         * @inheritdoc
         */
        public function getList(SearchCriteriaInterface $searchCriteria): AcceptOptionsPickupLocationRelationSearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * @inheritdoc
         */
        public function save(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation) : AcceptOptionsPickupLocationRelationInterface
        {
            $this->getResourceModel()->save($acceptOptionsPickupLocationRelation);
            $this->_idIndex[ $acceptOptionsPickupLocationRelation->getId() ] = $acceptOptionsPickupLocationRelation;
            return $acceptOptionsPickupLocationRelation;
        }

        /**
         * @inheritdoc
         */
        public function delete(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation) : bool
        {
            return $this->getResourceModel()->delete($acceptOptionsPickupLocationRelation);
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_acceptOptionsPickupLocationRelationFactory;
        protected function getAcceptOptionsPickupLocationRelationFactory() : AcceptOptionsPickupLocationRelationInterfaceFactory
        {
            return $this->_acceptOptionsPickupLocationRelationFactory;
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