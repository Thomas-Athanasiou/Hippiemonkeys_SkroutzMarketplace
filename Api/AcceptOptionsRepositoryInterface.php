<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface;

    interface AcceptOptionsRepositoryInterface
    {
        /**
         * Gets Accept Options from the persistent storage by its Id
         *
         * @api
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface
         */
        function getById($id): AcceptOptionsInterface;

        /**
         * Get Accept Options from the persistent storage by its Order
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface $order
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface
         */
        function getByOrder(OrderInterface $order): AcceptOptionsInterface;

        /**
         * Deletes Accept Options from the persistent storage
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface $acceptOptions
         *
         * @return bool
         */
        function delete(AcceptOptionsInterface $acceptOptions): bool;

        /**
         * Saves Accept Options to the persistent storage
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface $acceptOptions
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface
         */
        function save(AcceptOptionsInterface $acceptOptions): AcceptOptionsInterface;
    }
?>