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

    namespace Hippiemonkeys\SkroutzMarketplace\Api\Data;

    use Magento\Catalog\Api\Data\ProductInterface,
        Hippiemonkeys\Core\Api\Data\ModelInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface;

    interface LineItemInterface
    extends ModelInterface
    {
        /**
         * Gets ID
         *
         * @api
         * @access public
         *
         * @return mixed.
         */
        function getId();

        /**
         * Sets ID
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return int|null.
         */
        function getLocalId();

        /**
         * Sets Local ID
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return string.
         */
        function getSkroutzId(): string;

        /**
         * Sets Skroutz ID
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return int
         */
        function getShopUid(): int;

        /**
         * Sets Shop Uid
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface|null
         */
        function getSize();

        /**
         * Sets size
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface $size
         *
         * @return $this
         */
        function setSize($size);

        /**
         * Gets product name
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getProductName() : string;

        /**
         * Sets product name
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return int
         */
        function getQuantity() : int;

        /**
         * Sets Quantity
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return float
         */
        function getUnitPrice() : float;

        /**
         * Sets Unit Price
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return float
         */
        function getTotalPrice() : float;

        /**
         * Sets Total Price
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return bool
         */
        function getPriceIncludesVat() : bool;

        /**
         * Sets Price Includes Vat
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return string|null
         */
        function getEan();

        /**
         * Sets Ean
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return bool|null
         */
        function getIslandVatDiscountApplied();

        /**
         * Sets Island Vat Discount Applied
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return string|null
         */
        function getExtraInfo();

        /**
         * Sets extra info
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function getOrder() : OrderInterface;

        /**
         * Sets order
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return $this
         */
        function setOrder(OrderInterface $order);

        /**
         * Gets Rejection Reason
         *
         * @api
         * @access public
         *
         * @return string|null
         */
        function getRejectionReason();

        /**
         * Sets Rejection Reason
         *
         * @api
         * @access public
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
         * @access public
         *
         * @return string|null
         */
        function getReturnReason();

        /**
         * Sets Return Reason
         *
         * @api
         * @access public
         *
         * @param string|null $returnReason
         *
         * @return $this
         */
        function setReturnReason($returnReason);

        /**
         * Gets Serial Number
         *
         * @api
         * @access public
         *
         * @return string|null
         */
        function getSerialNumbers();

        /**
         * Sets Serial Number
         *
         * @api
         * @access public
         *
         * @param string|null $serialNumbers
         *
         * @return $this
         */
        function setSerialNumbers($serialNumbers);

        /**
         * Gets Ean
         *
         * @api
         * @access public
         *
         * @return \Magento\Catalog\Api\Data\ProductInterface
         */
        function getProduct(): ProductInterface;

        /**
         * Sets Ean
         *
         * @api
         * @access public
         *
         * @param \Magento\Catalog\Api\Data\ProductInterface $product
         *
         * @return $this
         */
        function setProduct(ProductInterface $product);

        /**
         * Gets shop variation uid
         *
         * @api
         * @access public
         *
         * @return string.
         */
        function getShopVariationUid();

        /**
         * Sets shop variation uid
         *
         * @api
         * @access public
         *
         * @param string|null $shop_variation_uid
         * @return $this
         */
        function setShopVariationUid($shopVariationUid);
    }
?>