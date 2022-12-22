<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    interface AddressInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string
         */
        function getStreetName(): string;

        /**
         * Sets street name
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string
         */
        function getStreetNumber() : string;

        /**
         * Set street number
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string
         */
        function getZip() : string;

        /**
         * Sets zip
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string
         */
        function getCity() : string;

        /**
         * Sets city
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string
         */
        function getRegion() : string;

        /**
         * Sets region
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string
         */
        function getCountryCode() : string;

        /**
         * Sets Country Code
         *
         * @api
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
         * @api
         * @access public
         *
         * @return bool|null
         */
        function getPickupFromCollectionPoint(): ?bool;

        /**
         * Sets pickup from collection point
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string
         */
        function getCollectionPointAddress() : string;

        /**
         * Sets collection point address
         *
         * @api
         * @access public
         *
         * @param string $collectionPointAddress
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function setCollectionPointAddress(string $collectionPointAddress): AddressInterface;
    }
?>