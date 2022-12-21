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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface AddressResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_STREET_NAME = 'street_name',
            FIELD_STREET_NUMBER = 'street_number',
            FIELD_ZIP = 'zip',
            FIELD_CITY = 'city',
            FIELD_REGION = 'region',
            FIELD_COUNTRY_CODE = 'country_code',
            FIELD_PICKUP_FROM_COLLECTION_POINT = 'pickup_from_collection_point',
            FIELD_COLLECTION_POINT_ADDRESS = 'collection_point_address';

        /**
         * Save Address data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface $address
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressResourceInterface
         */
        function saveAddress(AddressInterface $address): AddressResourceInterface;

        /**
         * Load a Address by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface $address
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressResourceInterface
         */
        function loadAddressById(AddressInterface $address, $id): AddressResourceInterface;

        /**
         * Delete the Address
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface $address
         *
         * @return bool
         */
        function deleteAddress(AddressInterface $Address): bool;
    }
?>