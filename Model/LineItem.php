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
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\LineItem as ResourceModel;

    class LineItem
    extends AbstractModel
    implements LineItemInterface
    {
        protected const
            FIELD_ORDER = 'order',
            FIELD_PRODUCT = 'product',
            FIELD_SIZE = 'size';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
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
            $this->_productRepository = $productRepository;
            $this->_orderRepository = $orderRepository;
        }

        /**
         * {@inheritdoc}
         */
        public function getSkroutzId(): string
        {
            return $this->getData(ResourceModel::FIELD_SKROUTZ_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function setSkroutzId(string $skroutzId): LineItem
        {
            return $this->setData(ResourceModel::FIELD_SKROUTZ_ID, $skroutzId);
        }

        /**
         * {@inheritdoc}
         */
        public function getShopUid(): int
        {
            return $this->getData(ResourceModel::FIELD_SHOPUID);
        }

        /**
         * {@inheritdoc}
         */
        public function setShopUid(int $uid): LineItem
        {
            return $this->setData(ResourceModel::FIELD_SHOPUID, $uid);
        }

        /**
         * {@inheritdoc}
         */
        public function getProductName() : string
        {
            return $this->getData(ResourceModel::FIELD_PRODUCT_NAME);
        }

        /**
         * {@inheritdoc}
         */
        public function setProductName(string $productName): LineItem
        {
            return $this->setData(ResourceModel::FIELD_PRODUCT_NAME, $productName);
        }

        /**
         * {@inheritdoc}
         */
        public function getQuantity() : int
        {
            return (int) $this->getData(ResourceModel::FIELD_QUANTITY);
        }

        /**
         * {@inheritdoc}
         */
        public function setQuantity(int $quantity): LineItem
        {
            return $this->setData(ResourceModel::FIELD_QUANTITY, $quantity);
        }

        /**
         * {@inheritdoc}
         */
        public function getUnitPrice() : float
        {
            return (float) $this->getData(ResourceModel::FIELD_UNIT_PRICE);
        }

        /**
         * {@inheritdoc}
         */
        public function setUnitPrice(float $unitPrice): LineItem
        {
            return $this->setData(ResourceModel::FIELD_UNIT_PRICE, $unitPrice);
        }

        /**
         * {@inheritdoc}
         */
        public function getTotalPrice() : float
        {
            return (float) $this->getData(ResourceModel::FIELD_TOTAL_PRICE);
        }

        /**
         * {@inheritdoc}
         */
        public function setTotalPrice(float $totalPrice): LineItem
        {
            return $this->setData(ResourceModel::FIELD_TOTAL_PRICE, $totalPrice);
        }

        /**
         * {@inheritdoc}
         */
        public function getPriceIncludesVat() : bool
        {
            return (int) $this->getData(ResourceModel::FIELD_PRICE_INCLUDES_VAT);
        }

        /**
         * {@inheritdoc}
         */
        public function setPriceIncludesVat(bool $priceIncludesVat): LineItem
        {
            return $this->setData(ResourceModel::FIELD_PRICE_INCLUDES_VAT, $priceIncludesVat);
        }

        /**
         * {@inheritdoc}
         */
        public function getIslandVatDiscountApplied(): ?bool
        {
            return (bool) $this->getData(ResourceModel::FIELD_ISLAND_VAT_DISCOUNT_APPLIED);
        }
        /**
         * {@inheritdoc}
         */
        public function setIslandVatDiscountApplied(?bool $islandVatDiscountApplied): LineItem
        {
            return $this->setData(ResourceModel::FIELD_ISLAND_VAT_DISCOUNT_APPLIED, $islandVatDiscountApplied);
        }

        /**
         * {@inheritdoc}
         */
        public function getEan(): string
        {
            return $this->getData(ResourceModel::FIELD_EAN);
        }

        /**
         * {@inheritdoc}
         */
        public function setEan($ean): LineItem
        {
            return $this->setData(ResourceModel::FIELD_EAN, $ean);
        }

        /**
         * {@inheritdoc}
         */
        public function getExtraInfo(): ?string
        {
            return $this->getData(ResourceModel::FIELD_EXTRA_INFO);
        }
        /**
         * {@inheritdoc}
         */
        public function setExtraInfo(?string $extraInfo): LineItem
        {
            return $this->setData(ResourceModel::FIELD_EXTRA_INFO, $extraInfo);
        }

        /**
         * {@inheritdoc}
         */
        public function getSize(): ?SizeInterface
        {
            return $this->getData(self::FIELD_SIZE);
        }
        /**
         * {@inheritdoc}
         */
        public function setSize(?SizeInterface $size): LineItem
        {
            return $this->setData(self::FIELD_SIZE, $size);
        }

        /**
         * {@inheritdoc}
         */
        public function getOrder() : OrderInterface
        {
            $order      = $this->getData(self::FIELD_ORDER);
            $orderId    = $this->getData(self::FIELD_ORDER_ID);
            if ($orderId !== null && $order === null)
            {
                $order = $this->getOrderRepository()->getById($orderId);
                $this->setData(self::FIELD_PRODUCT, $order);
            }
            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function setOrder(OrderInterface $order): LineItem
        {
            $this->setData(ResourceModel::FIELD_ORDER_ID, $order->getId());
            return $this->setData(self::FIELD_ORDER, $order);
        }

        /**
         * {@inheritdoc}
         */
        public function getRejectionReason(): ?string
        {
            return $this->getData(ResourceModel::FIELD_REJECTION_REASON);
        }

        /**
         * {@inheritdoc}
         */
        public function setRejectionReason($rejectionReason)
        {
            return $this->setData(ResourceModel::FIELD_REJECTION_REASON, $rejectionReason);
        }

        /**
         * {@inheritdoc}
         */
        public function getReturnReason()
        {
            return $this->getData(ResourceModel::FIELD_RETURN_REASON);
        }

        /**
         * {@inheritdoc}
         */
        public function setReturnReason($returnReason)
        {
            return $this->setData(ResourceModel::FIELD_RETURN_REASON, $returnReason);
        }

        /**
         * {@inheritdoc}
         */
        public function getSerialNumbers()
        {
            return $this->getData(ResourceModel::FIELD_SERIAL_NUMBERS);
        }

        /**
         * {@inheritdoc}
         */
        public function setSerialNumbers($serialNumbers)
        {
            return $this->setData(ResourceModel::FIELD_SERIAL_NUMBERS, $serialNumbers);
        }

        /**
         * {@inheritdoc}
         */
        public function getShopVariationUid()
        {
            return $this->getData(ResourceModel::FIELD_SHOP_VARIATION_UID);
        }

        /**
         * {@inheritdoc}
         */
        public function setShopVariationUid($shopVariationUid)
        {
            return $this->setData(ResourceModel::FIELD_SHOP_VARIATION_UID, $shopVariationUid);
        }

        /**
         * {@inheritdoc}
         */
        function getProduct(): ProductInterface
        {
            $product    = $this->getData(self::FIELD_PRODUCT);
            $productId  = $this->getShopUid();
            if ($productId !== null && $product === null)
            {
                $product = $this->getProductRepository()->getById($productId);
                $this->setData(self::FIELD_PRODUCT, $product);
            }
            return $product;
        }
        /**
         * {@inheritdoc}
         */
        function setProduct(ProductInterface $product)
        {
            $this->setShopUid((int) $product->getId());
            return $this->setData(self::FIELD_PRODUCT, $product);
        }

        private $_productRepository;
        protected function getProductRepository(): ProductRepositoryInterface
        {
            return $this->_productRepository;
        }

        private $_orderRepository;
        protected function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->_orderRepository;
        }
    }
?>