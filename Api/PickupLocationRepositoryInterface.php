<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
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
         * @param int $localId
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface
         * @throws \Exception
         */
        function getByLocalId(int $localId): PickupLocationInterface;
        /**
         * Gets Pickup Location by skroutz id
         *
         * @param string $skroutzId
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface
         * @throws \Exception
         */
        function getBySkroutzId(string $skroutzId): PickupLocationInterface;
        /**
         * Deletes the Pickup Location instance from the repository
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface $pickupLocation
         * @return bool
         * @throws \Exception
         */
        function delete(PickupLocationInterface $pickupLocation): bool;
        /**
         * Saves the Pickup Location instance to the repository
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface $pickupLocation
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface
         * @throws \Exception
         */
        function save(PickupLocationInterface $pickupLocation): PickupLocationInterface;
    }
?>