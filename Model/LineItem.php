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

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Magento\Catalog\Api\Data\ProductInterface,
        Magento\Catalog\Api\ProductRepositoryInterface,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface as ResourceInterface;

    class LineItem
    extends AbstractModel
    implements LineItemInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            ProductRepositoryInterface $productRepository,
            OrderRepositoryInterface $orderRepository,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->productRepository = $productRepository;
            $this->orderRepository = $orderRepository;

            $this->size = null;
            $this->order = null;
            $this->product = null;
        }

        /**
         * @inheritdoc
         */
        public function getSkroutzId(): string
        {
            return $this->getData(ResourceInterface::FIELD_SKROUTZ_ID);
        }

        /**
         * @inheritdoc
         */
        public function setSkroutzId(string $skroutzId): self
        {
            return $this->setData(ResourceInterface::FIELD_SKROUTZ_ID, $skroutzId);
        }

        /**
         * @inheritdoc
         */
        public function getShopUid()
        {
            return $this->getData(ResourceInterface::FIELD_SHOPUID);
        }

        /**
         * @inheritdoc
         */
        public function setShopUid($uid): self
        {
            return $this->setData(ResourceInterface::FIELD_SHOPUID, $uid);
        }

        /**
         * @inheritdoc
         */
        public function getProductName(): string
        {
            return $this->getData(ResourceInterface::FIELD_PRODUCT_NAME);
        }

        /**
         * @inheritdoc
         */
        public function setProductName(string $productName): self
        {
            return $this->setData(ResourceInterface::FIELD_PRODUCT_NAME, $productName);
        }

        /**
         * @inheritdoc
         */
        public function getQuantity(): int
        {
            return (int) $this->getData(ResourceInterface::FIELD_QUANTITY);
        }

        /**
         * @inheritdoc
         */
        public function setQuantity(int $quantity): self
        {
            return $this->setData(ResourceInterface::FIELD_QUANTITY, $quantity);
        }

        /**
         * @inheritdoc
         */
        public function getUnitPrice(): float
        {
            return (float) $this->getData(ResourceInterface::FIELD_UNIT_PRICE);
        }

        /**
         * @inheritdoc
         */
        public function setUnitPrice(float $unitPrice): self
        {
            return $this->setData(ResourceInterface::FIELD_UNIT_PRICE, $unitPrice);
        }

        /**
         * @inheritdoc
         */
        public function getTotalPrice(): float
        {
            return (float) $this->getData(ResourceInterface::FIELD_TOTAL_PRICE);
        }

        /**
         * @inheritdoc
         */
        public function setTotalPrice(float $totalPrice): self
        {
            return $this->setData(ResourceInterface::FIELD_TOTAL_PRICE, $totalPrice);
        }

        /**
         * @inheritdoc
         */
        public function getPriceIncludesVat(): bool
        {
            return (int) $this->getData(ResourceInterface::FIELD_PRICE_INCLUDES_VAT);
        }

        /**
         * @inheritdoc
         */
        public function setPriceIncludesVat(bool $priceIncludesVat): self
        {
            return $this->setData(ResourceInterface::FIELD_PRICE_INCLUDES_VAT, $priceIncludesVat);
        }

        /**
         * @inheritdoc
         */
        public function getIslandVatDiscountApplied(): ?bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_ISLAND_VAT_DISCOUNT_APPLIED);
        }

        /**
         * @inheritdoc
         */
        public function setIslandVatDiscountApplied(?bool $islandVatDiscountApplied): self
        {
            return $this->setData(ResourceInterface::FIELD_ISLAND_VAT_DISCOUNT_APPLIED, $islandVatDiscountApplied);
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
         * @inheritdoc
         */
        public function getExtraInfo(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_EXTRA_INFO);
        }

        /**
         * @inheritdoc
         */
        public function setExtraInfo(?string $extraInfo): self
        {
            return $this->setData(ResourceInterface::FIELD_EXTRA_INFO, $extraInfo);
        }

        /**
         * Size property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        private $size;

        /**
         * @inheritdoc
         */
        public function getSize(): ?SizeInterface
        {
            return $this->size;
        }

        /**
         * @inheritdoc
         */
        public function setSize(?SizeInterface $size): self
        {
            $this->size = $size;
            return $this;
        }

        /**
         * Order property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        private $order;

        /**
         * @inheritdoc
         */
        public function getOrder(): OrderInterface
        {
            $order = $this->order;
            if ($order === null)
            {
                $order = $this->getOrderRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_ORDER_ID)
                );
                $this->order = $order;
            }
            return $order;
        }

        /**
         * @inheritdoc
         */
        public function setOrder(OrderInterface $order): self
        {
            $this->order = $order;
            return $this->setData(ResourceInterface::FIELD_ORDER_ID, $order->getId());
        }

        /**
         * @inheritdoc
         */
        public function getRejectionReason(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_REJECTION_REASON);
        }

        /**
         * @inheritdoc
         */
        public function setRejectionReason(?string $rejectionReason): self
        {
            return $this->setData(ResourceInterface::FIELD_REJECTION_REASON, $rejectionReason);
        }

        /**
         * @inheritdoc
         */
        public function getReturnReason(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_RETURN_REASON);
        }

        /**
         * @inheritdoc
         */
        public function setReturnReason(?string $returnReason): self
        {
            return $this->setData(ResourceInterface::FIELD_RETURN_REASON, $returnReason);
        }

        /**
         * @inheritdoc
         */
        public function getSerialNumbers(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_SERIAL_NUMBERS);
        }

        /**
         * @inheritdoc
         */
        public function setSerialNumbers(?string $serialNumbers): self
        {
            return $this->setData(ResourceInterface::FIELD_SERIAL_NUMBERS, $serialNumbers);
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
                /**TODO: More product ids */
                $product = $this->getProductRepository()->getById(
                    $this->getShopUid()
                );
                $this->product = $product;
            }
            return $product;
        }

        /**
         * @inheritdoc
         */
        public function setProduct(ProductInterface $product): self
        {
            /**TODO: More product ids */
            $this->product = $product;
            return $this->setShopUid((int) $product->getId());
        }

        /**
         * Product Repository property
         *
         * @access private
         *
         * @var \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
         */
        private $productRepository;

        /**
         *  Gets Product Repository
         *
         * @access protected
         * @final
         *
         * @return \Magento\Catalog\Api\ProductRepositoryInterface
         */
        protected final function getProductRepository(): ProductRepositoryInterface
        {
            return $this->productRepository;
        }

        /**
         * Order Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         */
        private $orderRepository;

        /**
         * Gets Order Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        protected final function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->orderRepository;
        }
    }
?>