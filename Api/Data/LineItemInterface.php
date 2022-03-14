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

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    use Magento\Catalog\Api\Data\ProductInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface;

    interface LineItemInterface
    {
        /**
         * Gets ID
         *
         * @return mixed.
         */
        function getId();

        /**
         * Sets ID
         *
         * @param mixed $value
         * @return $this
         */
        function setId($id);

        /**
         * Gets Local ID
         *
         * @return int|null.
         */
        function getLocalId();

        /**
         * Sets Local ID
         *
         * @param int $localId
         * @return $this
         */
        function setLocalId(int $localId);

        /**
         * Gets Skroutz ID
         *
         * @return string.
         */
        function getSkroutzId(): string;

        /**
         * Sets Skroutz ID
         *
         * @param string $value
         * @return $this
         */
        function setSkroutzId(string $skroutzId);

        /**
         * Get shop uid
         *
         * @return int
         */
        function getShopUid(): int;

        /**
         * Set shop uid
         *
         * @param string $shop_uid
         * @return $this
         */
        function setShopUid(int $shopUid);

        /**
         * Get size
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\SizeInterface|null
         */
        function getSize();

        /**
         * Set size
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\SizeInterface $size
         * @return $this
         */
        function setSize($size);

        /**
         * Get product name
         *
         * @return string
         */
        function getProductName() : string;

        /**
         * Set product name
         *
         * @param string $product_name
         * @return $this
         */
        function setProductName(string $productName);

        /**
         * Get quantity
         *
         * @return int
         */
        function getQuantity() : int;

        /**
         * Set quantity
         *
         * @param int $quantity
         * @return $this
         */
        function setQuantity(int $quantity);

        /**
         * Get unit price
         * @return float
         */
        function getUnitPrice() : float;

        /**
         * Set unit price
         *
         * @param float $unit_price
         * @return $this
         */
        function setUnitPrice(float $unitPrice);

        /**
         * Get unit price
         *
         * @return float
         */
        function getTotalPrice() : float;

        /**
         * Set unit price
         *
         * @param float $total_price
         * @return $this
         */
        function setTotalPrice(float $totalPrice);

        /**
         * Get price includes vat
         *
         * @return bool
         */
        function getPriceIncludesVat() : bool;

        /**
         * Set price includes vat
         *
         * @param bool $price_includes_vat
         * @return $this
         */
        function setPriceIncludesVat(bool $priceIncludesVat);

        /**
         * Get ean
         *
         * @return string|null
         */
        function getEan();

        /**
         * Set ean
         *
         * @param string|null $ean
         * @return $this
         */
        function setEan($ean);

        /**
         * Get Island Vat Discount Applied
         *
         * @return bool|null
         */
        function getIslandVatDiscountApplied();

        /**
         * Set Island Vat Discount Applied
         *
         * @param bool|null $ean
         * @return $this
         */
        function setIslandVatDiscountApplied($islandVatDistcountApplied);

        /**
         * Get extra info
         *
         * @return string|null
         */
        function getExtraInfo();

        /**
         * Set extra info
         *
         * @param string|null $extraInfo
         * @return $this
         */
        function setExtraInfo($extraInfo);

        /**
         * Get order
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface
         */
        function getOrder() : OrderInterface;

        /**
         * Set order
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface $order
         * @return $this
         */
        function setOrder(OrderInterface $order);

        /**
         * Get ean
         * @return \Magento\Catalog\Api\Data\ProductInterface
         */
        function getProduct(): ProductInterface;

        /**
         * Set ean
         * @param \Magento\Catalog\Api\Data\ProductInterface $product
         * @return $this
         */
        function setProduct(ProductInterface $product);
    }
?>