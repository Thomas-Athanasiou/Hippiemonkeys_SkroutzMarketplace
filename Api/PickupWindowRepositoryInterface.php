<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface;

    interface PickupWindowRepositoryInterface
    {
        /**
         * Gets Pickup Window instance by Local ID
         *
         * @param mixed $localId
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface
         * @throws \Exception
         */
        function getByLocalId(int $localId): PickupWindowInterface;
        /**
         * Gets Pickup Window instance by Skroutz ID
         *
         * @param mixed $skroutzId
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface
         * @throws \Exception
         */
        function getBySkroutzId(int $skroutzId): PickupWindowInterface;
        function delete(PickupWindowInterface $pickupWindow): bool;
        function save(PickupWindowInterface $pickupWindow): PickupWindowInterface;
    }
?>