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

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface;

    interface PickupWindowRepositoryInterface
    {
        /**
         * Gets Pickup Window instance by Local ID
         *
         * @api
         *
         * @param mixed $localId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface
         */
        function getByLocalId(int $localId): PickupWindowInterface;

        /**
         * Gets Pickup Window instance by Skroutz ID
         *
         * @api
         *
         * @param mixed $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface
         */
        function getBySkroutzId(int $skroutzId): PickupWindowInterface;

        function delete(PickupWindowInterface $pickupWindow): bool;

        function save(PickupWindowInterface $pickupWindow): PickupWindowInterface;
    }
?>