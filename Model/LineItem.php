<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Magento\Framework\Model\ResourceModel\AbstractResource,
        Magento\Framework\Data\Collection\AbstractDb,
        Magento\Catalog\Api\Data\ProductInterface,
        Magento\Catalog\Api\ProductRepositoryInterface,

        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\LineItem as ResourceModel;

    class LineItem
    extends AbstractModel
    implements LineItemInterface
    {
        protected const
            FIELD_ORDER     = 'order',
            FIELD_PRODUCT   = 'product',
            FIELD_SIZE      = 'size';

        public function __construct(
            Context $context,
            Registry $registry,
            ProductRepositoryInterface $productRepository,
            OrderRepositoryInterface $orderRepository,
            AbstractResource $resource = null,
            AbstractDb $resourceCollection = null,
            array $data = []
        )
        {
            parent::__construct(
                $context,
                $registry,
                $resource,
                $resourceCollection,
                $data
            );
            $this->_productRepository = $productRepository;
        }
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getLocalId()
        {
            return (int) $this->getData(ResourceModel::FIELD_LOCAL_ID);
        }
        /**
         * @inheritdoc
         */
        public function setLocalId(int $localId)
        {
            return $this->setData(ResourceModel::FIELD_LOCAL_ID, (string) $localId);
        }

        /**
         * @inheritdoc
         */
        function getSkroutzId(): string
        {
            return $this->getData(ResourceModel::FIELD_SKROUTZ_ID);
        }
        /**
         * @inheritdoc
         */
        function setSkroutzId(string $skroutzId)
        {
            return $this->setData(ResourceModel::FIELD_SKROUTZ_ID, $skroutzId);
        }

        /**
         * @inheritdoc
         */
        public function getShopUid(): int
        {
            return $this->getData(ResourceModel::FIELD_SHOPUID);
        }
        /**
         * @inheritdoc
         */
        public function setShopUid(int $uid)
        {
            return $this->setData(ResourceModel::FIELD_SHOPUID, $uid);
        }

        /**
         * @inheritdoc
         */
        public function getProductName() : string
        {
            return $this->getData(ResourceModel::FIELD_PRODUCT_NAME);
        }
        /**
         * @inheritdoc
         */
        public function setProductName(string $productName)
        {
            return $this->setData(ResourceModel::FIELD_PRODUCT_NAME, $productName);
        }

        /**
         * @inheritdoc
         */
        public function getQuantity() : int
        {
            return (int) $this->getData(ResourceModel::FIELD_QUANTITY);
        }
        /**
         * @inheritdoc
         */
        public function setQuantity(int $quantity)
        {
            return $this->setData(ResourceModel::FIELD_QUANTITY, $quantity);
        }

        /**
         * @inheritdoc
         */
        public function getUnitPrice() : float
        {
            return (float) $this->getData(ResourceModel::FIELD_UNIT_PRICE);
        }
        /**
         * @inheritdoc
         */
        public function setUnitPrice(float $unitPrice)
        {
            return $this->setData(ResourceModel::FIELD_UNIT_PRICE, $unitPrice);
        }

        /**
         * @inheritdoc
         */
        public function getTotalPrice() : float
        {
            return (float) $this->getData(ResourceModel::FIELD_TOTAL_PRICE);
        }
        /**
         * @inheritdoc
         */
        public function setTotalPrice(float $totalPrice)
        {
            return $this->setData(ResourceModel::FIELD_TOTAL_PRICE, $totalPrice);
        }

        /**
         * @inheritdoc
         */
        public function getPriceIncludesVat() : bool
        {
            return (int) $this->getData(ResourceModel::FIELD_PRICE_INCLUDES_VAT);
        }
        /**
         * @inheritdoc
         */
        public function setPriceIncludesVat(bool $priceIncludesVat)
        {
            return $this->setData(ResourceModel::FIELD_PRICE_INCLUDES_VAT, $priceIncludesVat);
        }

        /**
         * @inheritdoc
         */
        public function getIslandVatDiscountApplied()
        {
            return (int) $this->getData(ResourceModel::FIELD_ISLAND_VAT_DISCOUNT_APPLIED);
        }
        /**
         * @inheritdoc
         */
        public function setIslandVatDiscountApplied($islandVatDiscountApplied)
        {
            return $this->setData(ResourceModel::FIELD_ISLAND_VAT_DISCOUNT_APPLIED, $islandVatDiscountApplied);
        }

        /**
         * @inheritdoc
         */
        public function getEan()
        {
            return $this->getData(ResourceModel::FIELD_EAN);
        }
        /**
         * @inheritdoc
         */
        public function setEan($ean)
        {
            return $this->setData(ResourceModel::FIELD_EAN, $ean);
        }

        /**
         * @inheritdoc
         */
        public function getExtraInfo()
        {
            return $this->getData(ResourceModel::FIELD_EXTRA_INFO);
        }
        /**
         * @inheritdoc
         */
        public function setExtraInfo($extraInfo)
        {
            return $this->setData(ResourceModel::FIELD_EXTRA_INFO, $extraInfo);
        }

        /**
         * @inheritdoc
         */
        public function getSize()
        {
            return $this->getData(self::FIELD_SIZE);
        }
        /**
         * @inheritdoc
         */
        public function setSize($size)
        {
            return $this->setData(self::FIELD_SIZE, $size);
        }

        /**
         * @inheritdoc
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
         * @inheritdoc
         */
        public function setOrder(OrderInterface $order)
        {
            $this->setData(ResourceModel::FIELD_ORDER_ID, $order->getId());
            return $this->setData(self::FIELD_ORDER, $order);
        }

        /**
         * @inheritdoc
         */
        public function getRejectionReason()
        {
            return $this->getData(ResourceModel::FIELD_REJECTION_REASON);
        }

        /**
         * @inheritdoc
         */
        public function setRejectionReason($rejectionReason)
        {
            return $this->setData(ResourceModel::FIELD_REJECTION_REASON, $rejectionReason);
        }

        /**
         * @inheritdoc
         */
        public function getReturnReason()
        {
            return $this->getData(ResourceModel::FIELD_RETURN_REASON);
        }

        /**
         * @inheritdoc
         */
        public function setReturnReason($returnReason)
        {
            return $this->setData(ResourceModel::FIELD_RETURN_REASON, $returnReason);
        }

        /**
         * @inheritdoc
         */
        public function getSerialNumbers()
        {
            return $this->getData(ResourceModel::FIELD_SERIAL_NUMBERS);
        }

        /**
         * @inheritdoc
         */
        public function setSerialNumbers($serialNumbers)
        {
            return $this->setData(ResourceModel::FIELD_SERIAL_NUMBERS, $serialNumbers);
        }

        /**
         * @inheritdoc
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
         * @inheritdoc
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