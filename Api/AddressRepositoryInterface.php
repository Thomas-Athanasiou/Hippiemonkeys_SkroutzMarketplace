<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
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
         * @param int $id
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface
         * @throws \Exception
         */
        function getById(int $id): AddressInterface;
        /**
         * Delete Address
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface $address
         * @return bool
         */
        function delete(AddressInterface $address): bool;
        /**
         * Save Address
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface $address
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface
         */
        function save(AddressInterface $address): AddressInterface;
    }
?>