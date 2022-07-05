<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface;

    interface PickupLocationRepositoryInterface
    {
        /**
         * Gets Pickup Location by local id
         *
         * @api
         *
         * @param int $localId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface
         */
        function getByLocalId(int $localId): PickupLocationInterface;

        /**
         * Gets Pickup Location by skroutz id
         *
         * @api
         *
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface
         */
        function getBySkroutzId(string $skroutzId): PickupLocationInterface;

        /**
         * Deletes the Pickup Location instance from the repository
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return bool
         */
        function delete(PickupLocationInterface $pickupLocation): bool;

        /**
         * Saves the Pickup Location instance to the repository
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface
         */
        function save(PickupLocationInterface $pickupLocation): PickupLocationInterface;
    }
?>