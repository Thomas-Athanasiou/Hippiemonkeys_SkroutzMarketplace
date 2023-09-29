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

    /**
     * @api
     */
    interface PickupWindowInterface
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
         * @return int
         */
        function getSkroutzId(): int;

        /**
         * Sets Skroutz ID
         *
         * @access public
         *
         * @param int $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface
         */
        function setSkroutzId(int $skroutzId): PickupWindowInterface;

        /**
         * Get Label
         *
         * @access public
         *
         * @return string
         */
        function getLabel(): string;

        /**
         * Get label
         *
         * @access public
         *
         * @param string $label
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface
         */
        function setLabel(string $label): PickupWindowInterface;
    }
?>