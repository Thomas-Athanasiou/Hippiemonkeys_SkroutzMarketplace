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

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    interface LineItemRejectionReasonInterface
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
         * @return $this
         */
        function setId($id);

        /**
         * Gets Skroutz ID
         *
         * @api
         * @access public
         *
         * @return int.
         */
        function getSkroutzId(): int;

        /**
         * Sets Skroutz ID
         *
         * @api
         * @access public
         *
         * @param int $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface
         */
        function setSkroutzId(int $skroutzId): LineItemRejectionReasonInterface;

        /**
         * Get Label
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getLabel(): string;

        /**
         * Get label
         *
         * @param string $label
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface
         */
        function setLabel(string $label): LineItemRejectionReasonInterface;

        /**
         * Get requires available quantity
         *
         * @api
         * @access public
         *
         * @return bool
         */
        function getRequiresAvailableQuantity(): bool;

        /**
         * Get requires available quantity
         *
         * @api
         * @access public
         *
         * @param bool $requiresAvailableQuantity
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface
         */
        function setRequiresAvailableQuantity(bool $requiresAvailableQuantity): LineItemRejectionReasonInterface;
    }
?>