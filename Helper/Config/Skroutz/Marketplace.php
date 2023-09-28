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

    namespace Hippiemonkeys\SkroutzMarketplace\Helper\Config\Skroutz;

    use Magento\Framework\App\Helper\Context,
        Magento\Framework\Api\SearchCriteriaBuilder,
        Magento\Framework\Exception\NoSuchEntityException,
        Magento\Catalog\Api\Data\ProductInterface as MagentoProductInterface,
        Magento\Catalog\Api\ProductRepositoryInterface as MagentoProductRepositoryInterface,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface,
        Hippiemonkeys\Skroutz\Helper\Config\Skroutz,
        Hippiemonkeys\SkroutzMarketplace\Api\Helper\Config\Skroutz\MarketplaceInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Config\Source\MagentoProductIdentityField;

    class Marketplace
    extends Skroutz
    implements MarketplaceInterface
    {
       /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\App\Helper\Context $context
         * @param string $section
         * @param string $group
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $parentConfig
         * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
         * @param \Magento\Catalog\Api\ProductRepositoryInterface $magentoProductRepository
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         * @param string|null $activeField
         */
        public function __construct(
            Context $context,
            string $section,
            string $group,
            ConfigInterface $parentConfig,
            MagentoProductRepositoryInterface $magentoProductRepository,
            SearchCriteriaBuilder $searchCriteriaBuilder,
            ?string $activeField = self::CONFIG_FIELD_ACTIVE
        )
        {
            parent::__construct($context, $section, $group, $parentConfig, $activeField);
            $this->magentoProductRepository = $magentoProductRepository;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;

            $searchCriteriaBuilder->setPageSize(1);
            $searchCriteriaBuilder->setCurrentPage(1);
        }

        /**
         * {@inheritdoc}
         */
        public function getMagentoProductIdentity(MagentoProductInterface $magentoProduct): ?string
        {
            $code = null;

            switch ($this->getMagentoProductIdentityField())
            {
                case MagentoProductIdentityField::FIELD_ENTITY_ID:
                    $code = $magentoProduct->getId();
                    break;
                case MagentoProductIdentityField::FIELD_SKU:
                default:
                    $code = $magentoProduct->getSku();
                    break;
            }

            return $code;
        }

        public function getMagentoProductFromIdentity(string $identity): ?MagentoProductInterface
        {
            $product = null;
            $magentoProductRepository = $this->getMagentoProductRepository();

            try
            {
                switch ($this->getMagentoProductIdentityField())
                {
                    case MagentoProductIdentityField::FIELD_ENTITY_ID:
                        $product = $magentoProductRepository->getById((int) $identity);
                        break;
                    case MagentoProductIdentityField::FIELD_SKU:
                    default:
                        $product = $magentoProductRepository->get($identity);
                        break;
                }
            }
            catch(NoSuchEntityException)
            {

            }

            return $product;
        }

        /**
         * Gets Product Identity Field
         *
         * @access public
         *
         * @return string
         */
        protected function getMagentoProductIdentityField(): string
        {
            return $this->getData('magento_product_identity_field');
        }

        /**
         * Magento Product Repository property
         *
         * @access private
         *
         * @var \Magento\Catalog\Api\ProductRepositoryInterface $magentoProductRepository
         */
        private $magentoProductRepository;

        /**
         * Gets Magento Order Repository
         *
         * @access public
         *
         * @return \Magento\Catalog\Api\ProductRepositoryInterface
         */
        public function getMagentoProductRepository(): MagentoProductRepositoryInterface
        {
            return $this->magentoProductRepository;
        }

        /**
         * Search Criteria Builder property
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
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