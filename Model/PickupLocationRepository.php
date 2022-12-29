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
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $_idCache
             */
            $_idCache = [],

            /**
             * Skroutz Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $_skroutzIdCache
             */
            $_skroutzIdCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupLocationResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterfaceFactory $pickupLocationFactory
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         */
        public function __construct(
            ResourceInterface $resource,
            PickupLocationInterfaceFactory $pickupLocationFactory,
            SearchResultInterfaceFactory $searchResultFactory,
            CollectionProcessorInterface $collectionProcessor
        )
        {
            $this->_resource = $resource;
            $this->_pickupLocationFactory = $pickupLocationFactory;
            $this->_searchResultFactory = $searchResultFactory;
            $this->_collectionProcessor = $collectionProcessor;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : PickupLocationInterface
        {
            $pickupLocation = $this->_idCache[$id] ?? null;
            if($pickupLocation === null)
            {
                $pickupLocation = $this->getPickupLocationFactory()->create();
                $this->getResource()->loadPickupLocationById($pickupLocation, $id);
                if ($pickupLocation->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Location with id "%1" that was requested doesn\'t exist. Verify the pickupLocation and try again.', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $pickupLocation;
                    $this->_skroutzIdCache[$pickupLocation->getSkroutzId()] = $pickupLocation;
                }
            }
            return $pickupLocation;
        }

        /**
         * {@inheritdoc}
         */
        public function getBySkroutzId(string $skroutzId) : PickupLocationInterface
        {
            $pickupLocation = $this->_skroutzIdCache[$skroutzId] ?? null;
            if($pickupLocation === null)
            {
                $pickupLocation = $this->getPickupLocationFactory()->create();
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
                    $this->_idCache[$id] = $pickupLocation;
                    $this->_skroutzIdCache[$skroutzId] = $pickupLocation;
                }
            }
            return $pickupLocation;
        }

        /**
         * {@inheritdoc}
         */
        public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface
        {
            $searchResult = $this->getSearchResultFactory()->create();
            $searchResult->setSearchCriteria($searchCriteria);
            $this->getCollectionProcessor()->process($searchCriteria, $searchResult);
            return $searchResult;
        }

        /**
         * {@inheritdoc}
         */
        public function save(PickupLocationInterface $pickupLocation) : PickupLocationInterface
        {
            $this->getResource()->savePickupLocation($pickupLocation);
            $this->_skroutzIdCache[$pickupLocation->getSkroutzId()] = $pickupLocation;
            $this->_idCache[$pickupLocation->getId()] = $pickupLocation;
            return $pickupLocation;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(PickupLocationInterface $pickupLocation) : bool
        {
            unset($this->_idCache[$pickupLocation->getId()]);
            unset($this->_skroutzIdCache[$pickupLocation->getSkroutzId()]);
            return $this->getResource()->deletePickupLocation($pickupLocation);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupLocationResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupLocationResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Pickup Location Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterfaceFactory $_pickupLocationFactory
         */
        private $_pickupLocationFactory;

        /**
         * Gets Pickup Location Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterfaceFactory
         */
        protected function getPickupLocationFactory() : PickupLocationInterfaceFactory
        {
            return $this->_pickupLocationFactory;
        }

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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationSearchResultInterfaceFactory $_searchResultFactory
         */
        private $_searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
        {
            return $this->_searchResultFactory;
        }
    }
?>