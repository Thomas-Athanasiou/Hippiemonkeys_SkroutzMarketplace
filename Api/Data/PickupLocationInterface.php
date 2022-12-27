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

    interface PickupLocationInterface
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
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface
         */
        function setSkroutzId(string $skroutzId): PickupLocationInterface;

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
         * @api
         * @access public
         *
         * @param string $label
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface
         */
        function setLabel(string $label): PickupLocationInterface;
    }
?>