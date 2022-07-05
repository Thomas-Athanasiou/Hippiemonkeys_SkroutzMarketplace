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

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface;

    interface AddressRepositoryInterface
    {
        /**
         * Get Address by id
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface
         */
        function getById($id): AddressInterface;

        /**
         * Delete Address
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface $address
         *
         * @return bool
         */
        function delete(AddressInterface $address): bool;

        /**
         * Save Address
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface $address
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface
         */
        function save(AddressInterface $address): AddressInterface;
    }
?>