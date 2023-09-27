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
        Magento\Framework\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\VatExclusionRepresentativeResourceInterface as ResourceInterface;

    class VatExclusionRepresentativeRepository
    implements VatExclusionRepresentativeRepositoryInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\VatExclusionRepresentativeResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterfaceFactory $factory
         * @param \Hippiemonkeys\ShippingTrack\Api\Data\PickupLocationSearchResultInterfaceFactory $searchResultFactory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        public function __construct(
            ResourceInterface $resource,
            VatExclusionRepresentativeInterfaceFactory $factory,
            SearchResultInterfaceFactory $searchResultFactory,
            CollectionProcessorInterface $collectionProcessor,
            SearchCriteriaBuilder $searchCriteriaBuilder
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
            $this->searchResultFactory = $searchResultFactory;
            $this->collectionProcessor = $collectionProcessor;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * Id Cache property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface[] $idCache
         */
        protected $idCache = [];

        /**
         * @inheritdoc
         */
        public function getById($id) : VatExclusionRepresentativeInterface
        {
            $vatExclusionRepresentative = $this->idCache[$id] ?? null;
            if($vatExclusionRepresentative === null)
            {
                $vatExclusionRepresentative = $this->getFactory()->create();
                $this->getResource()->loadVatExclusionRepresentativeById($vatExclusionRepresentative, $id, ResourceInterface::FIELD_ID);
                if ($vatExclusionRepresentative->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Vat Exclusion Representative with id "%1" that was requested doesn\'t exist. Verify the Vat Exclusion Representative and try again.', $id)
                    );
                }
                else
                {
                    $this->idCache[$id] = $vatExclusionRepresentative;
                }
            }

            return $vatExclusionRepresentative;
        }

        /**
         * @inheritdoc
         */
        public function getByIdTypeAndIdNumber(string $idType, string $idNumber): VatExclusionRepresentativeInterface
        {
            $searchCriteriaBuilder = $this->getSearchCriteriaBuilder();
            $vatExclusionRepresentatives = $this->getList(
                $searchCriteriaBuilder
                    ->addFilter(ResourceInterface::FIELD_ID_TYPE, $idType, 'eq')
                    ->addFilter(ResourceInterface::FIELD_ID_NUMBER, $idNumber, 'eq')
                    ->setPageSize(1)
                    ->create()
            )->getItems();

            $searchCriteriaBuilder->setPageSize(null);
            $vatExclusionRepresentative = reset($vatExclusionRepresentatives);
            if($vatExclusionRepresentative === false)
            {
                throw new NoSuchEntityException(
                    __('The Vat Exclusion Representative with Id Type "%1" and Id Number "%2" that was requested doesn\'t exist. Verify the PVat Exclusion Representative and try again', $idType, $idNumber)
                );
            }
            return $vatExclusionRepresentative;
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
        public function save(VatExclusionRepresentativeInterface $vatExclusionRepresentative) : VatExclusionRepresentativeInterface
        {
            $this->getResource()->saveVatExclusionRepresentative($vatExclusionRepresentative);
            $this->idCache[$vatExclusionRepresentative->getId()] = $vatExclusionRepresentative;
            return $vatExclusionRepresentative;
        }

        /**
         * @inheritdoc
         */
        public function delete(VatExclusionRepresentativeInterface $vatExclusionRepresentative) : bool
        {
            unset($this->idCache[$vatExclusionRepresentative->getId()]);
            return $this->getResource()->deleteVatExclusionRepresentative($vatExclusionRepresentative);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\VatExclusionRepresentativeResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\VatExclusionRepresentativeResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Pickup Window Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Pickup Window Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterfaceFactory
         */
        protected function getFactory() : VatExclusionRepresentativeInterfaceFactory
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeSearchResultInterfaceFactory $searchResultFactory
         */
        private $searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeSearchResultInterfaceFactory
         */
        protected function getSearchResultFactory(): SearchResultInterfaceFactory
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
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected function getSearchCriteriaBuilder(): SearchCriteriaBuilder
        {
            return $this->searchCriteriaBuilder;
        }
    }
?>