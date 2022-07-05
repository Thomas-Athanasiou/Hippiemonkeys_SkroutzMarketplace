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

    interface AddressInterface
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
         * Gets street name
         *
         * @api
         *
         * @return string
         */
        function getStreetName() : string;

        /**
         * Sets street name
         *
         * @api
         *
         * @param string $streetName
         *
         * @return \this
         */
        function setStreetName(string $streetName);

        /**
         * Get street number
         *
         * @api
         *
         * @return string
         */
        function getStreetNumber() : string;

        /**
         * Set street number
         *
         * @api
         *
         * @param string $streetNumber
         *
         * @return \this
         */
        function setStreetNumber(string $streetNumber);

        /**
         * Gets zip
         *
         * @api
         *
         * @return string
         */
        function getZip() : string;

        /**
         * Sets zip
         *
         * @api
         *
         * @param string $zip
         *
         * @return \this
         */
        function setZip(string $zip);

        /**
         * Gets city
         *
         * @api
         *
         * @return string
         */
        function getCity() : string;

        /**
         * Sets city
         *
         * @api
         *
         * @param string $city
         *
         * @return \this
         */
        function setCity(string $city);

        /**
         * Gets region
         *
         * @api
         *
         * @return string
         */
        function getRegion() : string;

        /**
         * Sets region
         *
         * @api
         *
         * @param string $region
         *
         * @return \this
         */
        function setRegion(string $region);

        /**
         * Gets Country Code
         *
         * @api
         *
         * @return string
         */
        function getCountryCode() : string;

        /**
         * Sets Country Code
         *
         * @api
         *
         * @param string $countryCode
         *
         * @return \this
         */
        function setCountryCode(string $countryCode);

        /**
         * Gets pickup from collection point
         *
         * @api
         *
         * @return bool|null
         */
        function getPickupFromCollectionPoint();

        /**
         * Sets pickup from collection point
         *
         * @api
         *
         * @param bool|null $pickupFromCollectionPoint
         *
         * @return \this
         */
        function setPickupFromCollectionPoint($pickupFromCollectionPoint);

        /**
         * Gets collection point address
         *
         * @api
         *
         * @return string
         */
        function getCollectionPointAddress() : string;

        /**
         * Sets collection point address
         *
         * @api
         *
         * @param string $collectionPointAddress
         *
         * @return \this
         */
        function setCollectionPointAddress(string $collectionPointAddress);
    }
?>