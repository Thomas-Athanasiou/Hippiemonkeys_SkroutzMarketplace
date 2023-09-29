<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    /**
     * @api
     */
    interface AddressInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @access public
         *
         * @param mixed $value
         *
         * @return mixed
         */
        function setId($id);

        /**
         * Gets street name
         *
         * @access public
         *
         * @return string
         */
        function getStreetName(): string;

        /**
         * Sets street name
         *
         * @access public
         *
         * @param string $streetName
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function setStreetName(string $streetName): AddressInterface;

        /**
         * Get street number
         *
         * @access public
         *
         * @return string
         */
        function getStreetNumber() : string;

        /**
         * Set street number
         *
         * @access public
         *
         * @param string $streetNumber
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function setStreetNumber(string $streetNumber): AddressInterface;

        /**
         * Gets zip
         *
         * @access public
         *
         * @return string
         */
        function getZip() : string;

        /**
         * Sets zip
         *
         * @access public
         *
         * @param string $zip
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function setZip(string $zip): AddressInterface;

        /**
         * Gets city
         *
         * @access public
         *
         * @return string
         */
        function getCity() : string;

        /**
         * Sets city
         *
         * @access public
         *
         * @param string $city
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function setCity(string $city): AddressInterface;

        /**
         * Gets region
         *
         * @access public
         *
         * @return string
         */
        function getRegion() : string;

        /**
         * Sets region
         *
         * @access public
         *
         * @param string $region
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function setRegion(string $region): AddressInterface;

        /**
         * Gets Country Code
         *
         * @access public
         *
         * @return string
         */
        function getCountryCode() : string;

        /**
         * Sets Country Code
         *
         * @access public
         *
         * @param string $countryCode
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function setCountryCode(string $countryCode): AddressInterface;

        /**
         * Gets pickup from collection point
         *
         * @access public
         *
         * @return bool|null
         */
        function getPickupFromCollectionPoint(): ?bool;

        /**
         * Sets pickup from collection point
         *
         * @access public
         *
         * @param bool|null $pickupFromCollectionPoint
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function setPickupFromCollectionPoint(?bool $pickupFromCollectionPoint): AddressInterface;

        /**
         * Gets collection point address
         *
         * @access public
         *
         * @return string|null
         */
        function getCollectionPointAddress() : ?string;

        /**
         * Sets collection point address
         *
         * @access public
         *
         * @param string|null $collectionPointAddress
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function setCollectionPointAddress(?string $collectionPointAddress): AddressInterface;
    }
?>