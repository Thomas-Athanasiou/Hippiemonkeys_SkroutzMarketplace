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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface;

    interface PickupLocationRepositoryInterface
    {
        /**
         * Gets Pickup Location by Id
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface
         */
        function getById($id): PickupLocationInterface;

        /**
         * Gets Pickup Location by Skroutz Id
         *
         * @api
         * @access public
         *
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface
         */
        function getBySkroutzId(string $skroutzId): PickupLocationInterface;

        /**
         * Deletes the Pickup Location instance from the repository
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return bool
         */
        function delete(PickupLocationInterface $pickupLocation): bool;

        /**
         * Saves the Pickup Location instance to the repository
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface
         */
        function save(PickupLocationInterface $pickupLocation): PickupLocationInterface;
    }
?>