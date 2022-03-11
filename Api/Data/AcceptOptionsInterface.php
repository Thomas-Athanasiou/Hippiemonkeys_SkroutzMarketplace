<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface AcceptOptionsInterface
    {
        /**
         * Gets ID
         *
         * @return mixed.
         */
        function getId();

        /**
         * Sets ID
         *
         * @param mixed $value
         * @return $this
         */
        function setId($id);

        /**
         * Get number of parcels
         *
         * @return int[]
         */
        function getNumberOfParcels() : array;

        /**
         * Set number of parcels
         *
         * @param int[] $numberOfParcels
         * @return $this
         */
        function setNumberOfParcels(array $numberOfParcels);

        /**
         * Get pickup locations
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface[]
         */
        function getPickupLocation(): array;

        /**
         * Set pickup locations
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface[] $pickupLocation
         * @return $this
         */
        function setPickupLocation(array $pickupLocation);

        /**
         * Get pickup windows
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface[]
         */
        function getPickupWindow(): array;

        /**
         * Set pickup windows
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface[] $pickupLocation
         * @return $this
         */
        function setPickupWindow(array $pickupWindow);

        /**
         * Get Order
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface
         */
        function getOrder(): OrderInterface;

        /**
         * Set Order
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface $order
         * @return $this
         */
        function setOrder(OrderInterface $order);
    }
?>