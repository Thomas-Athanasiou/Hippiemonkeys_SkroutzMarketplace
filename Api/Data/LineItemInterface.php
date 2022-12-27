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
         * Sets ID
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string
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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setSkroutzId(string $skroutzId): LineItemInterface;

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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setShopUid(int $shopUid): LineItemInterface;

        /**
         * Gets size
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface|null
         */
        function getSize(): ?SizeInterface;

        /**
         * Sets size
         *
         * @api
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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setProductName(string $productName): LineItemInterface;

        /**
         * Gets Quantity
         *
         * @api
         * @access public
         *
         * @return int
         */
        function getQuantity(): int;

        /**
         * Sets Quantity
         *
         * @api
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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setUnitPrice(float $unitPrice): LineItemInterface;

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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setTotalPrice(float $totalPrice): LineItemInterface;

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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setPriceIncludesVat(bool $priceIncludesVat): LineItemInterface;

        /**
         * Gets Ean
         *
         * @api
         * @access public
         *
         * @return string|null
         */
        function getEan(): ?string;

        /**
         * Sets Ean
         *
         * @api
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
         * @api
         * @access public
         *
         * @return bool|null
         */
        function getIslandVatDiscountApplied(): ?bool;

        /**
         * Sets Island Vat Discount Applied
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string|null
         */
        function getExtraInfo(): ?string;

        /**
         * Sets extra info
         *
         * @api
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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setOrder(OrderInterface $order): LineItemInterface;

        /**
         * Gets Rejection Reason
         *
         * @api
         * @access public
         *
         * @return string|null
         */
        function getRejectionReason(): ?string;

        /**
         * Sets Rejection Reason
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string|null
         */
        function getReturnReason(): ?string;

        /**
         * Sets Return Reason
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string|null
         */
        function getSerialNumbers(): ?string;

        /**
         * Sets Serial Number
         *
         * @api
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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setProduct(ProductInterface $product);

        /**
         * Gets shop variation uid
         *
         * @api
         * @access public
         *
         * @return string|null
         */
        function getShopVariationUid(): ?string;

        /**
         * Sets shop variation uid
         *
         * @api
         * @access public
         *
         * @param string|null $shop_variation_uid
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function setShopVariationUid(?string $shopVariationUid): LineItemInterface;
    }
?>