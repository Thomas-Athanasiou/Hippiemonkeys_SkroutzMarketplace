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

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface AcceptOptionsInterface
    {
        /**
         * Gets ID
         *
         * @api
         *
         * @return mixed.
         */
        function getId();

        /**
         * Sets ID
         *
         * @api
         *
         * @param mixed $value
         *
         * @return \this
         */
        function setId($id);

        /**
         * Get number of parcels
         *
         * @api
         *
         * @return int[]
         */
        function getNumberOfParcels() : array;

        /**
         * Set number of parcels
         *
         * @api
         *
         * @param int[] $numberOfParcels
         *
         * @return \this
         */
        function setNumberOfParcels(array $numberOfParcels): AcceptOptionsInterface;

        /**
         * Get pickup locations
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface[]
         */
        function getPickupLocation(): array;

        /**
         * Set pickup locations
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface[] $pickupLocation
         *
         * @return \this
         */
        function setPickupLocation(array $pickupLocation) : AcceptOptionsInterface;

        /**
         * Get pickup windows
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface[]
         */
        function getPickupWindow(): array;

        /**
         * Set pickup windows
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface[] $pickupLocation
         *
         * @return \this
         */
        function setPickupWindow(array $pickupWindow): AcceptOptionsInterface;

        /**
         * Get Order
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface
         */
        function getOrder(): OrderInterface;

        /**
         * Set Order
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface $order
         *
         * @return \this
         */
        function setOrder(OrderInterface $order): AcceptOptionsInterface;
    }
?>