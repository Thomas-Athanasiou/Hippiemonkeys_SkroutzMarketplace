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

    interface AcceptOptionsPickupLocationRelationInterface
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
         * Gets Pickup Location
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface.
         */
        function getPickupLocation(): PickupLocationInterface;

        /**
         * Sets Pickup Location
         *
         * @api
         *
         * @param Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface $value
         *
         * @return $this
         */
        function setPickupLocation(PickupLocationInterface $pickupLocation);
    }
?>