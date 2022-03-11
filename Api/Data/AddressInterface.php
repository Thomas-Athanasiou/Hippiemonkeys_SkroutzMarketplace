<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface AddressInterface
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
         * Gets street name
         *
         * @return string
         */
        function getStreetName() : string;
        /**
         * Sets street name
         *
         * @param string $streetName
         * @return $this
         */
        function setStreetName(string $streetName);

        /**
         * Get street number
         *
         * @return string
         */
        function getStreetNumber() : string;

        /**
         * Set street number
         *
         * @param string $streetNumber
         * @return $this
         */
        function setStreetNumber(string $streetNumber);

        /**
         * Gets zip
         *
         * @return string
         */
        function getZip() : string;

        /**
         * Sets zip
         *
         * @param string $zip
         * @return $this
         */
        function setZip(string $zip);

        /**
         * Gets city
         *
         * @return string
         */
        function getCity() : string;

        /**
         * Sets city
         *
         * @param string $city
         * @return $this
         */
        function setCity(string $city);

        /**
         * Gets region
         *
         * @return string
         */
        function getRegion() : string;

        /**
         * Sets region
         *
         * @param string $region
         * @return $this
         */
        function setRegion(string $region);

        /**
         * Gets pickup from collection point
         *
         * @return bool|null
         */
        function getPickupFromCollectionPoint();

        /**
         * Sets pickup from collection point
         *
         * @param bool|null $pickupFromCollectionPoint
         * @return $this
         */
        function setPickupFromCollectionPoint($pickupFromCollectionPoint);

        /**
         * Gets collection point address
         *
         * @return string
         */
        function getCollectionPointAddress() : string;

        /**
         * Sets collection point address
         *
         * @param string $collectionPointAddress
         * @return $this
         */
        function setCollectionPointAddress(string $collectionPointAddress);
    }
?>