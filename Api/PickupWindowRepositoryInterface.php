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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface;

    interface PickupWindowRepositoryInterface
    {
        /**
         * Gets Pickup Window instance by ID
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface
         */
        function getById(int $id): PickupWindowInterface;

        /**
         * Gets Pickup Window instance by Skroutz ID
         *
         * @api
         * @access public
         *
         * @param int $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface
         */
        function getBySkroutzId(int $skroutzId): PickupWindowInterface;

        /**
         * Deletes the Pickup Window instance from the repository
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface $pickupWindow
         *
         * @return bool
         */
        function delete(PickupWindowInterface $pickupWindow): bool;

        /**
         * Saves the Pickup Window instance to the repository
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface $pickupWindow
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface
         */
        function save(PickupWindowInterface $pickupWindow): PickupWindowInterface;
    }
?>