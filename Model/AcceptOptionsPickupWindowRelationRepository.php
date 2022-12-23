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
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupWindowRelationResourceInterface as ResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface;

    class AcceptOptionsPickupWindowRelationRepository
    implements AcceptOptionsPickupWindowRelationRepositoryInterface
    {
        /**
         * Id Cache property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface $_idCache
         */
        protected $_idCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupWindowRelationResourceInterface  $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory $acceptOptionsPickupWindowRelationFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterfaceFactory $searchResulFactory
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        public function __construct(
            ResourceInterface $resource,
            AcceptOptionsPickupWindowRelationInterfaceFactory $acceptOptionsPickupWindowRelationFactory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResulFactory,
            SearchCriteriaBuilder $searchCriteriaBuilder
        )
        {
            $this->_resource = $resource;
            $this->_acceptOptionsPickupWindowRelationFactory = $acceptOptionsPickupWindowRelationFactory;
            $this->_collectionProcessor = $collectionProcessor;
            $this->_searchResultFactory = $searchResulFactory;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id): AcceptOptionsPickupWindowRelationInterface
        {
            $acceptOptionsPickupWindowRelation = $this->_idCache[$id] ?? null;
            if(!$acceptOptionsPickupWindowRelation)
            {
                $acceptOptionsPickupWindowRelation = $this->getAcceptOptionsPickupWindowRelationFactory()->create();
                $this->getResource()->loadAcceptOptionsPickupWindowRelationById($acceptOptionsPickupWindowRelation, $id, ResourceInterface::FIELD_ID);
                if (!$acceptOptionsPickupWindowRelation->getId())
                {
                    throw new NoSuchEntityException(
                        __('The relation with id "%1" that was requested doesn\'t exist. Verify the relation and try again.', $id)
                    );
                }
                $this->_idCache[$id] = $acceptOptionsPickupWindowRelation;
            }
            return $acceptOptionsPickupWindowRelation;
        }

        /**
         * {@inheritdoc}
         */
        public function getByAcceptOptionsAndPickupWindow(
            AcceptOptionsInterface $acceptOptions,
            PickupWindowInterface $pickupWindow
        ) : AcceptOptionsPickupWindowRelationInterface
        {
            $acceptOptionsId = $acceptOptions->getId();
            $pickupWindowId = $pickupWindow->getId();

            $searchCriteriaBuilder = $this->getSearchCriteriaBuilder();

            $acceptOptionsPickupLocationRelation = $this->getList(
                $searchCriteriaBuilder
                    ->addFilter(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID, $acceptOptionsId, 'eq')
                    ->addFilter(ResourceInterface::FIELD_PICKUP_WINDOW_ID, $pickupWindowId, 'eq')
                    ->create()
            )
            ->getItems() [0] ?? null;

            if($acceptOptionsPickupLocationRelation)
            {
                $this->_idCache[$acceptOptionsPickupLocationRelation->getId()] = $acceptOptionsPickupLocationRelation;
            }
            else
            {
                throw new NoSuchEntityException(
                    __('The Accept Options Pickup Location Relation with Accept Options ID "%1" and Pickup Window ID "%2" that was requested doesn\'t exist. Verify the Accept Options Pickup Wondow Relation and try again.', $acceptOptionsId, $pickupWindowId)
                );
            }

            return $acceptOptionsPickupLocationRelation;
        }

        /**
         * {@inheritdoc}
         */
        public function getList(SearchCriteriaInterface $searchCriteria): AcceptOptionsPickupWindowRelationSearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * {@inheritdoc}
         */
        public function save(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation) : AcceptOptionsPickupWindowRelationInterface
        {
            $this->getResource()->saveAcceptOptionsPickupWindowRelation($acceptOptionsPickupWindowRelation);
            $this->_idCache[ $acceptOptionsPickupWindowRelation->getId() ] = $acceptOptionsPickupWindowRelation;
            return $acceptOptionsPickupWindowRelation;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation) : bool
        {
            return $this->getResource()->deleteAcceptOptionsPickupWindowRelation($acceptOptionsPickupWindowRelation);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupWindowRelationResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupWindowRelationResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Accept Options Pickup Window Relation Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory $_acceptOptionsPickupWindowRelationFactory
         */
        private $_acceptOptionsPickupWindowRelationFactory;

        /**
         * Gets Accept Options Pickup Window Relation Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory
         */
        protected function getAcceptOptionsPickupWindowRelationFactory() : AcceptOptionsPickupWindowRelationInterfaceFactory
        {
            return $this->_acceptOptionsPickupWindowRelationFactory;
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterfaceFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterfaceFactory
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