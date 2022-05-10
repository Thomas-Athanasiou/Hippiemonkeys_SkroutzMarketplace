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
         * @api
         *
         * @return mixed.
         */
        function getId();

        /**
         * Sets ID
         *
         * @api
         *
         * @param mixed $id
         *
         * @return $this
         */
        function setId($id);

        /**
         * Gets Local ID
         *
         * @api
         *
         * @return int|null.
         */
        function getLocalId();

        /**
         * Sets Local ID
         *
         * @api
         *
         * @param int $localId
         *
         * @return $this
         */
        function setLocalId(int $localId);

        /**
         * Gets Skroutz ID
         *
         * @api
         *
         * @return string.
         */
        function getSkroutzId(): string;

        /**
         * Sets Skroutz ID
         *
         * @api
         *
         * @param string $value
         *
         * @return $this
         */
        function setSkroutzId(string $skroutzId);

        /**
         * Gets Shop Uid
         *
         * @api
         *
         * @return int
         */
        function getShopUid(): int;

        /**
         * Sets Shop Uid
         *
         * @api
         *
         * @param string $shopUid
         *
         * @return $this
         */
        function setShopUid(int $shopUid);

        /**
         * Gets size
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\SizeInterface|null
         */
        function getSize();

        /**
         * Sets size
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\SizeInterface $size
         *
         * @return $this
         */
        function setSize($size);

        /**
         * Gets product name
         *
         * @api
         *
         * @return string
         */
        function getProductName() : string;

        /**
         * Sets product name
         *
         * @api
         *
         * @param string $productName
         *
         * @return $this
         */
        function setProductName(string $productName);

        /**
         * Gets Quantity
         *
         * @api
         *
         * @return int
         */
        function getQuantity() : int;

        /**
         * Sets Quantity
         *
         * @api
         *
         * @param int $quantity
         *
         * @return $this
         */
        function setQuantity(int $quantity);

        /**
         * Gets Unit Price
         *
         * @api
         *
         * @return float
         */
        function getUnitPrice() : float;

        /**
         * Sets Unit Price
         *
         * @api
         *
         * @param float $unitPrice
         *
         * @return $this
         */
        function setUnitPrice(float $unitPrice);

        /**
         * Gets Total Price
         *
         * @api
         *
         * @return float
         */
        function getTotalPrice() : float;

        /**
         * Sets Total Price
         *
         * @api
         *
         * @param float $totalPrice
         *
         * @return $this
         */
        function setTotalPrice(float $totalPrice);

        /**
         * Gets Price Includes Vat
         *
         * @api
         *
         * @return bool
         */
        function getPriceIncludesVat() : bool;

        /**
         * Sets Price Includes Vat
         *
         * @api
         *
         * @param bool $priceIncludesVat
         *
         * @return $this
         */
        function setPriceIncludesVat(bool $priceIncludesVat);

        /**
         * Gets Ean
         *
         * @api
         *
         * @return string|null
         */
        function getEan();

        /**
         * Sets Ean
         *
         * @api
         *
         * @param string|null $ean
         *
         * @return $this
         */
        function setEan($ean);

        /**
         * Gets Island Vat Discount Applied
         *
         * @api
         *
         * @return bool|null
         */
        function getIslandVatDiscountApplied();

        /**
         * Sets Island Vat Discount Applied
         *
         * @api
         *
         * @param bool|null $ean
         *
         * @return $this
         */
        function setIslandVatDiscountApplied($islandVatDistcountApplied);

        /**
         * Gets extra info
         *
         * @api
         *
         * @return string|null
         */
        function getExtraInfo();

        /**
         * Sets extra info
         *
         * @api
         *
         * @param string|null $extraInfo
         *
         * @return $this
         */
        function setExtraInfo($extraInfo);

        /**
         * Gets Order
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface
         */
        function getOrder() : OrderInterface;

        /**
         * Sets order
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface $order
         *
         * @return $this
         */
        function setOrder(OrderInterface $order);

        /**
         * Gets Rejection Reason
         *
         * @api
         *
         * @return string|null
         */
        function getRejectionReason();

        /**
         * Sets Rejection Reason
         *
         * @api
         *
         * @param string|null $rejectionReason
         *
         * @return $this
         */
        function setRejectionReason($rejectionReason);

        /**
         * Gets Return Reason
         *
         * @api
         *
         * @return string|null
         */
        function getReturnReason();

        /**
         * Sets Return Reason
         *
         * @api
         *
         * @param string|null $returnReason
         *
         * @return $this
         */
        function setReturnReason($returnReason);

        /**
         * Gets Ean
         *
         * @api
         *
         * @return \Magento\Catalog\Api\Data\ProductInterface
         */
        function getProduct(): ProductInterface;

        /**
         * Sets Ean
         *
         * @api
         *
         * @param \Magento\Catalog\Api\Data\ProductInterface $product
         *
         * @return $this
         */
        function setProduct(ProductInterface $product);
    }
?>