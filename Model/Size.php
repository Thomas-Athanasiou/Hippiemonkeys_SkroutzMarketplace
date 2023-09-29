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

    use Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Magento\Catalog\Api\Data\ProductInterface,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\SizeResourceInterface as ResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Helper\Config\Skroutz\MarketplaceInterface as ConfigInterface;

    class Size
    extends AbstractModel
    implements SizeInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Helper\Config\Skroutz\MarketplaceInterface $config
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            ConfigInterface $config,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->config = $config;

            $this->product = null;
        }

        /**
         * @inheritdoc
         */
        public function getLabel(): string
        {
            return $this->getData(ResourceInterface::FIELD_LABEL);
        }

        /**
         * @inheritdoc
         */
        public function setLabel(string $label): self
        {
            return $this->setData(ResourceInterface::FIELD_LABEL, $label);
        }

        /**
         * @inheritdoc
         */
        public function getValue(): string
        {
            return $this->getData(ResourceInterface::FIELD_VALUE);
        }

        /**
         * @inheritdoc
         */
        public function setValue(string $value): self
        {
            return $this->setData(ResourceInterface::FIELD_VALUE, $value);
        }

        /**
         * @inheritdoc
         */
        public function getShopValue(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_SHOP_VALUE);
        }

        /**
         * @inheritdoc
         */
        public function setShopValue(?string $shopValue): self
        {
            return $this->setData(ResourceInterface::FIELD_SHOP_VALUE, $shopValue);
        }

        /**
         * @inheritdoc
         */
        public function getShopVariationUid(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_SHOP_VARIATION_UID);
        }

        /**
         * @inheritdoc
         */
        public function setShopVariationUid(?string $shopVariationUid): self
        {
            return $this->setData(ResourceInterface::FIELD_SHOP_VARIATION_UID, $shopVariationUid);
        }

        /**
         * @inheritdoc
         */
        public function getEan(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_EAN);
        }

        /**
         * @inheritdoc
         */
        public function setEan(?string $ean): self
        {
            return $this->setData(ResourceInterface::FIELD_EAN, $ean);
        }

        /**
         * Product property
         *
         * @access private
         *
         * @var \Magento\Catalog\Api\Data\ProductInterface
         */
        private $product;

        /**
         * @inheritdoc
         */
        public function getProduct(): ProductInterface
        {
            $product = $this->product;
            if ($product === null)
            {
                $product = $this->getConfig()->getMagentoProductFromIdentity($this->getShopUid());
                $this->product = $product;
            }
            return $product;
        }

        /**
         * @inheritdoc
         */
        public function setProduct(ProductInterface $product): self
        {
            $this->product = $product;
            return $this->setShopUid($this->getConfig()->getMagentoProductIdentity($product));
        }

        /**
         * Config property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Helper\Config\Skroutz\MarketplaceInterface $config
         */
        private $config;

        /**
         *  Gets Config
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Helper\Config\Skroutz\MarketplaceInterface
         */
        protected final function getConfig(): ConfigInterface
        {
            return $this->config;
        }
    }
?>