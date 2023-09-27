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
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface as ResourceInterface,
        Magento\Framework\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface;

    class AcceptOptionsPickupLocationRelationRepository
    implements AcceptOptionsPickupLocationRelationRepositoryInterface
    {
        /**
         * Id Cache property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface $idCache
         */
        protected $idCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface $resource,
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory $factory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        public function __construct(
            ResourceInterface $resource,
            AcceptOptionsPickupLocationRelationInterfaceFactory $factory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResultFactory,
            SearchCriteriaBuilder $searchCriteriaBuilder
        )
        {
            $this->resource = $resource;
            $this->factory  = $factory;
            $this->collectionProcessor = $collectionProcessor;
            $this->searchResultFactory = $searchResultFactory;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : AcceptOptionsPickupLocationRelationInterface
        {
            $acceptOptionsPickupLocationRelation = $this->idCache[$id] ?? null;
            if($acceptOptionsPickupLocationRelation === null)
            {
                $acceptOptionsPickupLocationRelation = $this->getFactory()->create();
                $this->getResource()->loadAcceptOptionsPickupLocationRelationById($acceptOptionsPickupLocationRelation, $id);
                if ($acceptOptionsPickupLocationRelation->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The relation with id "%1" that was requested doesn\'t exist. Verify the relation and try again.', $id)
                    );
                }
                else
                {
                    $this->idCache[$id] = $acceptOptionsPickupLocationRelation;
                }
            }
            return $acceptOptionsPickupLocationRelation;
        }

        /**
         * @inheritdoc
         */
        public function getByAcceptOptionsAndPickupLocation(AcceptOptionsInterface $acceptOptions, PickupLocationInterface $pickupLocation) : AcceptOptionsPickupLocationRelationInterface
        {
            $acceptOptionsId = $acceptOptions->getId();
            $pickupLocationId = $pickupLocation->getId();

            $acceptOptionsPickupLocationRelations = $this->getList(
                    $this->getSearchCriteriaBuilder()
                        ->addFilter(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID, $acceptOptionsId, 'eq')
                        ->addFilter(ResourceInterface::FIELD_PICKUP_LOCATION_ID, $pickupLocationId, 'eq')
                        ->create()
                )
                ->getItems();

            $acceptOptionsPickupLocationRelation = reset($acceptOptionsPickupLocationRelations);

            if($acceptOptionsPickupLocationRelation === false)
            {
                throw new NoSuchEntityException(
                    __('The Accept Options Pickup Location Relation with Accept Options ID "%1" and Pickup Location ID "%2" that was requested doesn\'t exist. Verify the Accept Options Pickup Location Relation and try again.', $acceptOptionsId, $pickupLocationId)
                );
            }
            else
            {
                $this->idCache[$acceptOptionsPickupLocationRelation->getId()] = $acceptOptionsPickupLocationRelation;
            }

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
            $this->getResource()->saveAcceptOptionsPickupLocationRelation($acceptOptionsPickupLocationRelation);
            $this->idCache[$acceptOptionsPickupLocationRelation->getId()] = $acceptOptionsPickupLocationRelation;
            return $acceptOptionsPickupLocationRelation;
        }

        /**
         * @inheritdoc
         */
        public function delete(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation) : bool
        {
            return $this->getResource()->deleteAcceptOptionsPickupLocationRelation($acceptOptionsPickupLocationRelation);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface
         */
        protected final function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Factory
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory
         */
        protected final function getFactory() : AcceptOptionsPickupLocationRelationInterfaceFactory
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterfaceFactory $searchResultFactory
         */
        private $searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterfaceFactory
         */
        protected final function getSearchResultFactory(): SearchResultInterfaceFactory
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
         * @final
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected final function getSearchCriteriaBuilder() : SearchCriteriaBuilder
        {
            return $this->searchCriteriaBuilder;
        }
    }
?>