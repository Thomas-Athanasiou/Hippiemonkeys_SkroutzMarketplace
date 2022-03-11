<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface AcceptOptionsPickupWindowRelationInterface
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
         * Gets Pickup Window
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface.
         */
        function getPickupWindow(): PickupWindowInterface;

        /**
         * Sets Pickup Window
         *
         * @param Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface $value
         * @return $this
         */
        function setPickupWindow(PickupWindowInterface $pickupWindow);
    }
?>