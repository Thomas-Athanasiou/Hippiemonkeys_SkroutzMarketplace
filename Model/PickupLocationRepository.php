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
        Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface,
        Magento\Framework\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupLocationResourceInterface as ResourceInterface;

    class PickupLocationRepository
    implements PickupLocationRepositoryInterface
    {
        protected
            /**
             * Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $idCache
             */
            $idCache = [],

            /**
             * Skroutz Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $skroutzIdCache
             */
            $skroutzIdCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupLocationResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterfaceFactory $factory
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        public function __construct(
            ResourceInterface $resource,
            PickupLocationInterfaceFactory $factory,
            SearchResultInterfaceFactory $searchResultFactory,
            CollectionProcessorInterface $collectionProcessor
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
            $this->searchResultFactory = $searchResultFactory;
            $this->collectionProcessor = $collectionProcessor;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : PickupLocationInterface
        {
            $pickupLocation = $this->idCache[$id] ?? null;
            if($pickupLocation === null)
            {
                $pickupLocation = $this->getFactory()->create();
                $this->getResource()->loadPickupLocationById($pickupLocation, $id);
                if ($pickupLocation->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Location with id "%1" that was requested doesn\'t exist. Verify the pickupLocation and try again.', $id)
                    );
                }
                else
                {
                    $this->idCache[$id] = $pickupLocation;
                    $this->skroutzIdCache[$pickupLocation->getSkroutzId()] = $pickupLocation;
                }
            }
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(string $skroutzId) : PickupLocationInterface
        {
            $pickupLocation = $this->skroutzIdCache[$skroutzId] ?? null;
            if($pickupLocation === null)
            {
                $pickupLocation = $this->getFactory()->create();
                $this->getResource()->loadPickupLocationBySkroutzId($pickupLocation, $skroutzId, ResourceInterface::FIELD_SKROUTZ_ID);
                $id = $pickupLocation->getId();
                if($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Location with skroutz id "%1" that was requested doesn\'t exist. Verify the pickupLocation and try again.', $skroutzId)
                    );
                }
                else
                {
                    $this->idCache[$id] = $pickupLocation;
                    $this->skroutzIdCache[$skroutzId] = $pickupLocation;
                }
            }
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * @inheritdoc
         */
        public function save(PickupLocationInterface $pickupLocation) : PickupLocationInterface
        {
            $this->getResource()->savePickupLocation($pickupLocation);
            $this->skroutzIdCache[$pickupLocation->getSkroutzId()] = $pickupLocation;
            $this->idCache[$pickupLocation->getId()] = $pickupLocation;
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function delete(PickupLocationInterface $pickupLocation) : bool
        {
            unset($this->idCache[$pickupLocation->getId()]);
            unset($this->skroutzIdCache[$pickupLocation->getSkroutzId()]);
            return $this->getResource()->deletePickupLocation($pickupLocation);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupLocationResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupLocationResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterfaceFactory
         */
        protected function getFactory() : PickupLocationInterfaceFactory
        {
            return $this->factory;
        }

        /**
         * Collection Processor property
         *
         * @access private
         *
         * @return \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        private $collectionProcessor;

        /**
         * Gets Collection Processor
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
         */
        protected function getCollectionProcessor() : CollectionProcessorInterface
        {
            return $this->collectionProcessor;
        }

        /**
         * Search Result Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationSearchResultInterfaceFactory $searchResultFactory
         */
        private $searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->searchResultFactory;
        }
    }
?>