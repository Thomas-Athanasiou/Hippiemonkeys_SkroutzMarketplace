<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface;

    interface CustomerRepositoryInterface
    {
        /**
         * Get Customer by local id
         *
         * @param int $localId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface
         */
        function getByLocalId(int $localId): CustomerInterface;

        /**
         * Get Customer skroutz id
         *
         * @param mixed $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface
         */
        function getBySkroutzId(string $skroutzId): CustomerInterface;

        /**
         * Delete Customer
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface $customer
         *
         * @return bool
         */
        function delete(CustomerInterface $customer): bool;

        /**
         * Save Customer
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface $customer
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface
         */
        function save(CustomerInterface $customer): CustomerInterface;
    }
?>