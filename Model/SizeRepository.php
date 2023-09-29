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
        Magento\Sales\Api\Data\SizeInterface as MagentoSizeInterface,
        Magento\Framework\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeSearchResultInterfaceFactory as SearchResultInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\SizeRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\SizeResourceInterface as ResourceInterface;

    class SizeRepository
    implements SizeRepositoryInterface
    {
        protected
            /**
             * Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface $idCache
             */
            $idCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\SizeResourceInterface $resource
         * @param \Hippiemonkeys\Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterfaceFactory $factory
         * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeSearchResultInterfaceFactory $searchResultFactory,
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        public function __construct(
            ResourceInterface $resource,
            SizeInterfaceFactory $factory,
            CollectionProcessorInterface $collectionProcessor,
            SearchResultInterfaceFactory $searchResultFactory,
            SearchCriteriaBuilder $searchCriteriaBuilder
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
            $this->collectionProcessor = $collectionProcessor;
            $this->searchResultFactory = $searchResultFactory;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : SizeInterface
        {
            $size = $this->idCache[$id] ?? null;
            if($size === null)
            {
                $size = $this->getFactory()->create();
                $this->getResource()->loadSizeById($size, $id);
                if ($size->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The size with id "%1" that was requested doesn\'t exist. Verify the size and try again.', $id)
                    );
                }
                else
                {
                    $this->idCache[$id] = $size;
                }
            }

            return $size;
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
        public function save(SizeInterface $size) : SizeInterface
        {
            $this->idCache[$size->getId()] = $size;
            $this->getResource()->saveSize($size);
            return $size;
        }

        /**
         * @inheritdoc
         */
        public function delete(SizeInterface $size) : bool
        {
            unset($this->idCache[$size->getId()]);
            return $this->getResource()->deleteSize($size);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\SizeResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\SizeResourceInterface
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterfaceFactory
         */
        protected function getFactory(): SizeInterfaceFactory
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
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeSearchResultInterfaceFactory $searchResultFactory
         */
        private $searchResultFactory;

        /**
         * Gets Search Result Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeSearchResultInterfaceFactory
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
        protected function getSearchCriteriaBuilder() : SearchCriteriaBuilder
        {
            return $this->searchCriteriaBuilder;
        }
    }
?>