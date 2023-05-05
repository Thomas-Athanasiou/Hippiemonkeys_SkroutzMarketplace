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

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    interface SizeInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string.
         */
        function getLabel(): string;

        /**
         * Sets Label
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string.
         */
        function getValue(): string;

        /**
         * Sets Value
         *
         * @api
         * @access public
         *
         * @param string|null $value
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function setValue(string $value): SizeInterface;

        /**
         * Gets shop value
         *
         * @api
         * @access public
         *
         * @return string|null.
         */
        function getShopValue(): ?string;

        /**
         * Sets shop value
         *
         * @api
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
         * @param string|null $shopVariationUid
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function setShopVariationUid(?string $shopVariationUid): SizeInterface;
    }
?>