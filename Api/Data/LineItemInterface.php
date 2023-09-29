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

    namespace Hippiemonkeys\SkroutzMarketplace\Api\Data;

    use Magento\Catalog\Api\Data\ProductInterface,
        Hippiemonkeys\Core\Api\Data\ModelInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface;

    /**
     * @api
     */
    interface LineItemInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return mixed
         */
        function setId($id);

        /**
         * Gets Skroutz ID
         *
         * @access public
         *
         * @return string
         */
        function getSkroutzId(): string;

        /**
         * Sets Skroutz ID
         *
         * @access public
         *
         * @param string $value
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setSkroutzId(string $skroutzId): LineItemInterface;

        /**
         * Gets Shop Uid
         *
         * @access public
         *
         * @return mixed
         */
        function getShopUid();

        /**
         * Sets Shop Uid
         *
         * @access public
         *
         * @param mixed $shopUid
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setShopUid($shopUid): LineItemInterface;

        /**
         * Gets size
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface|null
         */
        function getSize(): ?SizeInterface;

        /**
         * Sets size
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface|null $size
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setSize(?SizeInterface $size): LineItemInterface;

        /**
         * Gets product name
         *
         * @access public
         *
         * @return string
         */
        function getProductName() : string;

        /**
         * Sets product name
         *
         * @access public
         *
         * @param string $productName
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setProductName(string $productName): LineItemInterface;

        /**
         * Gets Quantity
         *
         * @access public
         *
         * @return int
         */
        function getQuantity(): int;

        /**
         * Sets Quantity
         *
         * @access public
         *
         * @param int $quantity
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setQuantity(int $quantity): LineItemInterface;

        /**
         * Gets Unit Price
         *
         * @access public
         *
         * @return float
         */
        function getUnitPrice() : float;

        /**
         * Sets Unit Price
         *
         * @access public
         *
         * @param float $unitPrice
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setUnitPrice(float $unitPrice): LineItemInterface;

        /**
         * Gets Total Price
         *
         * @access public
         *
         * @return float
         */
        function getTotalPrice() : float;

        /**
         * Sets Total Price
         *
         * @access public
         *
         * @param float $totalPrice
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setTotalPrice(float $totalPrice): LineItemInterface;

        /**
         * Gets Price Includes Vat
         *
         * @access public
         *
         * @return bool
         */
        function getPriceIncludesVat() : bool;

        /**
         * Sets Price Includes Vat
         *
         * @access public
         *
         * @param bool $priceIncludesVat
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setPriceIncludesVat(bool $priceIncludesVat): LineItemInterface;

        /**
         * Gets Ean
         *
         * @access public
         *
         * @return string|null
         */
        function getEan(): ?string;

        /**
         * Sets Ean
         *
         * @access public
         *
         * @param string|null $ean
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setEan(?string $ean): LineItemInterface;

        /**
         * Gets Island Vat Discount Applied
         *
         * @access public
         *
         * @return bool|null
         */
        function getIslandVatDiscountApplied(): ?bool;

        /**
         * Sets Island Vat Discount Applied
         *
         * @access public
         *
         * @param bool|null $ean
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setIslandVatDiscountApplied(?bool $islandVatDistcountApplied): LineItemInterface;

        /**
         * Gets extra info
         *
         * @access public
         *
         * @return string|null
         */
        function getExtraInfo(): ?string;

        /**
         * Sets extra info
         *
         * @access public
         *
         * @param string|null $extraInfo
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setExtraInfo(?string $extraInfo): LineItemInterface;

        /**
         * Gets Order
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function getOrder() : OrderInterface;

        /**
         * Sets order
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setOrder(OrderInterface $order): LineItemInterface;

        /**
         * Gets Rejection Reason
         *
         * @access public
         *
         * @return string|null
         */
        function getRejectionReason(): ?string;

        /**
         * Sets Rejection Reason
         *
         * @access public
         *
         * @param string|null $rejectionReason
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setRejectionReason(?string $rejectionReason): LineItemInterface;

        /**
         * Gets Return Reason
         *
         * @access public
         *
         * @return string|null
         */
        function getReturnReason(): ?string;

        /**
         * Sets Return Reason
         *
         * @access public
         *
         * @param string|null $returnReason
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setReturnReason(?string $returnReason): LineItemInterface;

        /**
         * Gets Serial Number
         *
         * @access public
         *
         * @return string|null
         */
        function getSerialNumbers(): ?string;

        /**
         * Sets Serial Number
         *
         * @access public
         *
         * @param string|null $serialNumbers
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setSerialNumbers(?string $serialNumbers): LineItemInterface;

        /**
         * Gets Ean
         *
         * @access public
         *
         * @return \Magento\Catalog\Api\Data\ProductInterface
         */
        function getProduct(): ProductInterface;

        /**
         * Sets Ean
         *
         * @access public
         *
         * @param \Magento\Catalog\Api\Data\ProductInterface $product
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setProduct(ProductInterface $product): LineItemInterface;

        /**
         * Gets shop variation uid
         *
         * @access public
         *
         * @return string|null
         */
        function getShopVariationUid(): ?string;

        /**
         * Sets shop variation uid
         *
         * @access public
         *
         * @param string|null $shop_variation_uid
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setShopVariationUid(?string $shopVariationUid): LineItemInterface;
    }
?>