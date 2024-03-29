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
        Hippiemonkeys\Core\Api\Data\ModelInterface;

    /**
     * @api
     */
    interface SizeInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @access public
         *
         * @param mixed $value
         *
         * @return mixed
         */
        function setId($id);

        /**
         * Gets Label
         *
         * @access public
         *
         * @return string.
         */
        function getLabel(): string;

        /**
         * Sets Label
         *
         * @access public
         *
         * @param string $label
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function setLabel(string $label): SizeInterface;

        /**
         * Gets Value
         *
         * @access public
         *
         * @return string.
         */
        function getValue(): string;

        /**
         * Sets Value
         *
         * @access public
         *
         * @param string|null $value
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function setValue(string $value): SizeInterface;

        /**
         * Gets shop value
         *
         * @access public
         *
         * @return string|null.
         */
        function getShopValue(): ?string;

        /**
         * Sets shop value
         *
         * @access public
         *
         * @param string|null $shopValue
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function setShopValue(?string $shopValue): SizeInterface;

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
         * @param string|null $shopVariationUid
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function setShopVariationUid(?string $shopVariationUid): SizeInterface;

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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function setEan(?string $ean): SizeInterface;

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
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function setProduct(ProductInterface $product): SizeInterface;
    }
?>