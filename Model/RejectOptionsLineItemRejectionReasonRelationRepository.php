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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationSearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface,

        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\RejectOptionsLineItemRejectionReasonRelation as ResourceModel;

    class RejectOptionsLineItemRejectionReasonRelationRepository
    implements RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
    {
        protected $_idIndex = [];

        public function __construct(
            ResourceModel $resourceModel,
            RejectOptionsLineItemRejectionReasonRelationInterfaceFactory $rejectOptionsLineItemRejectionReasonRelationFactory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResulFactory
        )
        {
            $this->_resourceModel                                       = $resourceModel;
            $this->_rejectOptionsLineItemRejectionReasonRelationFactory = $rejectOptionsLineItemRejectionReasonRelationFactory;
            $this->_collectionProcessor                                 = $collectionProcessor;
            $this->_searchResultFactory                                 = $searchResulFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : RejectOptionsLineItemRejectionReasonRelationInterface
        {
            $rejectOptionsLineItemRejectionReasonRelation = $this->_idIndex[$id] ?? null;
            if(!$rejectOptionsLineItemRejectionReasonRelation) {
                $rejectOptionsLineItemRejectionReasonRelation = $this->getRejectOptionsLineItemRejectionReasonRelationFactory()->create();
                $this->getResourceModel()->load($rejectOptionsLineItemRejectionReasonRelation, $id, ResourceModel::FIELD_ID);
                if (!$rejectOptionsLineItemRejectionReasonRelation->getId())
                {
                    throw new NoSuchEntityException(
                        __('The relation with id "%1" that was requested doesn\'t exist. Verify the relation and try again.', $id)
                    );
                }
                $this->_idIndex[$id] = $rejectOptionsLineItemRejectionReasonRelation;
            }
            return $rejectOptionsLineItemRejectionReasonRelation;
        }
        /**
         * @inheritdoc
         */
        public function getByRejectOptionsAndLineItemRejectionReason(
            RejectOptionsInterface $rejectOptions,
            LineItemRejectionReasonInterface $lineItemRejectionReason
        ) : RejectOptionsLineItemRejectionReasonRelationInterface
        {
            $rejectOptionsLineItemRejectionReasonRelation = $this->getRejectOptionsLineItemRejectionReasonRelationFactory()->create();
            $rejectOptionsId            = $rejectOptions->getId();
            $lineItemRejectionReasonId  = $lineItemRejectionReason->getLocalId();
            $this->getResourceModel()->loadByRejectOptionsIdAndLineItemRejectionReason(
                $rejectOptionsLineItemRejectionReasonRelation,
                $rejectOptionsId,
                $lineItemRejectionReasonId
            );
            $id = $rejectOptionsLineItemRejectionReasonRelation->getId();
            if (!$id)
            {
                throw new NoSuchEntityException(
                    __(
                        'The relation with Reject Options ID "%1" and Line Item Rejection Reason ID "%2" that was requested doesn\'t exist. Verify the relation and try again.',
                        $rejectOptionsId,
                        $lineItemRejectionReasonId
                    )
                );
            }
            $this->_idIndex[$id] = $rejectOptionsLineItemRejectionReasonRelation;
            return $rejectOptionsLineItemRejectionReasonRelation;
        }


        /**
         * @inheritdoc
         */
        public function getList(SearchCriteriaInterface $searchCriteria): RejectOptionsLineItemRejectionReasonRelationSearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * @inheritdoc
         */
        public function save(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation) : RejectOptionsLineItemRejectionReasonRelationInterface
        {
            $this->getResourceModel()->save($rejectOptionsLineItemRejectionReasonRelation);
            $this->_idIndex[ $rejectOptionsLineItemRejectionReasonRelation->getId() ] = $rejectOptionsLineItemRejectionReasonRelation;
            return $rejectOptionsLineItemRejectionReasonRelation;
        }

        /**
         * @inheritdoc
         */
        public function delete(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation) : bool
        {
            $this->getResourceModel()->delete($rejectOptionsLineItemRejectionReasonRelation);
            unset( $this->_idIndex[ $rejectOptionsLineItemRejectionReasonRelation->getId() ] );
            return $rejectOptionsLineItemRejectionReasonRelation->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_rejectOptionsLineItemRejectionReasonRelationFactory;
        protected function getRejectOptionsLineItemRejectionReasonRelationFactory() : RejectOptionsLineItemRejectionReasonRelationInterfaceFactory
        {
            return $this->_rejectOptionsLineItemRejectionReasonRelationFactory;
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