<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface AcceptOptionsPickupLocationRelationInterface
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
         * Gets Accept Options
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface.
         */
        function getAcceptOptions(): AcceptOptionsInterface;

        /**
         * Sets Accept Options
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface $value
         * @return $this
         */
        function setAcceptOptions(AcceptOptionsInterface $acceptOptions);

        /**
         * Gets Pickup Location
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface.
         */
        function getPickupLocation(): PickupLocationInterface;

        /**
         * Sets Pickup Location
         *
         * @param Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface $value
         * @return $this
         */
        function setPickupLocation(PickupLocationInterface $pickupLocation);
    }
?>