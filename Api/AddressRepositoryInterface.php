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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface;

    interface AddressRepositoryInterface
    {
        /**
         * Get Address by id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function getById($id): AddressInterface;

        /**
         * Delete Address
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface $address
         *
         * @return bool
         */
        function delete(AddressInterface $address): bool;

        /**
         * Save Address
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface $address
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function save(AddressInterface $address): AddressInterface;
    }
?>