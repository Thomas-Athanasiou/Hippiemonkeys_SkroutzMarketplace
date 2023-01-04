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
        Magento\Framework\Api\SearchCriteriaBuilder,
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface as ResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface $_idCache
         */
        protected $_idCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface $resource,
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory $acceptOptionsPickupLocationRelationFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterfaceFactory $searchResulFactory
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        public function __construct(
            ResourceInterface $resource,
            AcceptOptionsPickupLocationRelationInterfaceFactory $acceptOptionsPickupLocationRelationFactory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResulFactory,
            SearchCriteriaBuilder $searchCriteriaBuilder
        )
        {
            $this->_resource = $resource;
            $this->_acceptOptionsPickupLocationRelationFactory  = $acceptOptionsPickupLocationRelationFactory;
            $this->_collectionProcessor = $collectionProcessor;
            $this->_searchResultFactory = $searchResulFactory;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : AcceptOptionsPickupLocationRelationInterface
        {
            $acceptOptionsPickupLocationRelation = $this->_idCache[$id] ?? null;
            if($acceptOptionsPickupLocationRelation === null)
            {
                $acceptOptionsPickupLocationRelation = $this->getAcceptOptionsPickupLocationRelationFactory()->create();
                $this->getResource()->loadAcceptOptionsPickupLocationRelationById($acceptOptionsPickupLocationRelation, $id);
                if ($acceptOptionsPickupLocationRelation->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The relation with id "%1" that was requested doesn\'t exist. Verify the relation and try again.', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $acceptOptionsPickupLocationRelation;
                }
            }
            return $acceptOptionsPickupLocationRelation;
        }

        /**
         * {@inheritdoc}
         */
        public function getByAcceptOptionsAndPickupLocation(AcceptOptionsInterface $acceptOptions, PickupLocationInterface $pickupLocation) : AcceptOptionsPickupLocationRelationInterface
        {
            $acceptOptionsId = $acceptOptions->getId();
            $pickupLocationId = $pickupLocation->getId();

            $acceptOptionsPickupLocationRelation = $this->getList(
                $this->getSearchCriteriaBuilder()
                    ->addFilter(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID, $acceptOptionsId, 'eq')
                    ->addFilter(ResourceInterface::FIELD_PICKUP_LOCATION_ID, $pickupLocationId, 'eq')
                    ->create()
            )
            ->getItems() [0] ?? null;

            $id = $acceptOptionsPickupLocationRelation === null ? null : $acceptOptionsPickupLocationRelation->getId();
            if($id !== null)
            {
                $this->_idCache[$id] = $acceptOptionsPickupLocationRelation;
            }
            else
            {
                throw new NoSuchEntityException(
                    __('The Accept Options Pickup Location Relation with Accept Options ID "%1" and Pickup Location ID "%2" that was requested doesn\'t exist. Verify the Accept Options Pickup Location Relation and try again.', $acceptOptionsId, $pickupLocationId)
                );
            }

            return $acceptOptionsPickupLocationRelation;
        }

        /**
         * {@inheritdoc}
         */
        public function getList(SearchCriteriaInterface $searchCriteria): AcceptOptionsPickupLocationRelationSearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * {@inheritdoc}
         */
        public function save(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation) : AcceptOptionsPickupLocationRelationInterface
        {
            $this->getResource()->saveAcceptOptionsPickupLocationRelation($acceptOptionsPickupLocationRelation);
            $this->_idCache[$acceptOptionsPickupLocationRelation->getId()] = $acceptOptionsPickupLocationRelation;
            return $acceptOptionsPickupLocationRelation;
        }

        /**
         * {@inheritdoc}
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Accept Options Pickup Location Relation Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory $_acceptOptionsPickupLocationRelationFactory
         */
        private $_acceptOptionsPickupLocationRelationFactory;

        /**
         * Gets Accept Options Pickup Location Relation Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory
         */
        protected function getAcceptOptionsPickupLocationRelationFactory() : AcceptOptionsPickupLocationRelationInterfaceFactory
        {
            return $this->_acceptOptionsPickupLocationRelationFactory;
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
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterfaceFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->_searchResultFactory;
        }

        /**
         * Search Criteria Builder property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteriaBuilder $_searchCriteriaBuilder
         */
        private $_searchCriteriaBuilder;

        /**
         * Gets Search Criteria Builder
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected function getSearchCriteriaBuilder() : SearchCriteriaBuilder
        {
            return $this->_searchCriteriaBuilder;
        }
    }
?>