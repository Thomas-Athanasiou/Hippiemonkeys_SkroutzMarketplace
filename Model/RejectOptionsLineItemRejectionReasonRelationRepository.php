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
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsLineItemRejectionReasonRelationResourceInterface as ResourceInterface;

    class RejectOptionsLineItemRejectionReasonRelationRepository
    implements RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
    {
        /**
         * Id Cache property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\RejectOptionsLineItemRejectionReasonRelationResourceInterface $_idCache
         */
        protected $_idCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\RejectOptionsLineItemRejectionReasonRelationResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory $rejectOptionsLineItemRejectionReasonRelationFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationSearchResultInterfaceFactory $searchResultFactory
         */
        public function __construct(
            ResourceInterface $resource,
            RejectOptionsLineItemRejectionReasonRelationInterfaceFactory $rejectOptionsLineItemRejectionReasonRelationFactory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResultFactory
        )
        {
            $this->_resource = $resource;
            $this->_rejectOptionsLineItemRejectionReasonRelationFactory = $rejectOptionsLineItemRejectionReasonRelationFactory;
            $this->_collectionProcessor = $collectionProcessor;
            $this->_searchResultFactory = $searchResultFactory;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : RejectOptionsLineItemRejectionReasonRelationInterface
        {
            $rejectOptionsLineItemRejectionReasonRelation = $this->_idCache[$id] ?? null;
            if($rejectOptionsLineItemRejectionReasonRelation === null)
            {
                $rejectOptionsLineItemRejectionReasonRelation = $this->getRejectOptionsLineItemRejectionReasonRelationFactory()->create();
                $this->getResource()->loadRejectOptionsLineItemRejectionReasonRelationById($rejectOptionsLineItemRejectionReasonRelation, $id);
                if ($rejectOptionsLineItemRejectionReasonRelation->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The relation with id "%1" that was requested doesn\'t exist. Verify the relation and try again.', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $rejectOptionsLineItemRejectionReasonRelation;
                }
            }
            return $rejectOptionsLineItemRejectionReasonRelation;
        }

        /**
         * {@inheritdoc}
         */
        public function getByRejectOptionsAndLineItemRejectionReason(
            RejectOptionsInterface $rejectOptions,
            LineItemRejectionReasonInterface $lineItemRejectionReason
        ) : RejectOptionsLineItemRejectionReasonRelationInterface
        {
            $rejectOptionsId = $rejectOptions->getId();
            $lineItemRejectionReasonId = $lineItemRejectionReason->getId();

            $searchCriteriaBuilder = $this->getSearchCriteriaBuilder();

            $rejectOptionsPickupLocationRelation = $this->getList(
                $searchCriteriaBuilder
                    ->addFilter(ResourceInterface::FIELD_REJECT_OPTIONS_ID, $rejectOptionsId, 'eq')
                    ->addFilter(ResourceInterface::FIELD_LINE_ITEM_REJECTION_REASON_ID, $lineItemRejectionReasonId, 'eq')
                    ->create()
            )
            ->getItems() [0] ?? null;

            if($rejectOptionsPickupLocationRelation === null)
            {
                throw new NoSuchEntityException(
                    __('The Accept Options Pickup Location Relation with Accept Options ID "%1" and Pickup Window ID "%2" that was requested doesn\'t exist. Verify the Accept Options Pickup Wondow Relation and try again.', $rejectOptionsId, $lineItemRejectionReasonId)
                );
            }
            else
            {
                $this->_idCache[$rejectOptionsPickupLocationRelation->getId()] = $rejectOptionsPickupLocationRelation;
            }

            return $rejectOptionsPickupLocationRelation;
        }

        /**
         * {@inheritdoc}
         */
        public function getList(SearchCriteriaInterface $searchCriteria): RejectOptionsLineItemRejectionReasonRelationSearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * {@inheritdoc}
         */
        public function save(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation) : RejectOptionsLineItemRejectionReasonRelationInterface
        {
            $this->getResource()->saveRejectOptionsLineItemRejectionReasonRelation($rejectOptionsLineItemRejectionReasonRelation);
            $this->_idCache[$rejectOptionsLineItemRejectionReasonRelation->getId()] = $rejectOptionsLineItemRejectionReasonRelation;
            return $rejectOptionsLineItemRejectionReasonRelation;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation) : bool
        {
            unset($this->_idCache[$rejectOptionsLineItemRejectionReasonRelation->getId()]);
            return $this->getResource()->deleteRejectOptionsLineItemRejectionReasonRelation($rejectOptionsLineItemRejectionReasonRelation);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsLineItemRejectionReasonRelationResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsLineItemRejectionReasonRelationResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Reject Options Line Item Rejection Reason Relation Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory $_rejectOptionsLineItemRejectionReasonRelationFactory
         */
        private $_rejectOptionsLineItemRejectionReasonRelationFactory;

        /**
         * Gets Reject Options Line Item Rejection Reason Relation Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory
         */
        protected function getRejectOptionsLineItemRejectionReasonRelationFactory() : RejectOptionsLineItemRejectionReasonRelationInterfaceFactory
        {
            return $this->_rejectOptionsLineItemRejectionReasonRelationFactory;
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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationsearchResultFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationsearchResultFactory
         */
        protected function getSearchResultFactory()
        {
            return $this->_searchResultFactory;
        }
    }
?>