<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
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
         * @return $this
         */
        function setId($id);

        /**
         * Gets Accept Options
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface.
         */
        function getAcceptOptions(): AcceptOptionsInterface;

        /**
         * Sets Accept Options
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface $value
         *
         * @return $this
         */
        function setAcceptOptions(AcceptOptionsInterface $acceptOptions);

        /**
         * Gets Pickup Window
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface.
         */
        function getPickupWindow(): PickupWindowInterface;

        /**
         * Sets Pickup Window
         *
         * @api
         *
         * @param Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface $value
         * 
         * @return $this
         */
        function setPickupWindow(PickupWindowInterface $pickupWindow);
    }
?>