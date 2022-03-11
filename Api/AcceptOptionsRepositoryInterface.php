<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
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
         * Get Accept Options by id
         *
         * @param int $id
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface
         * @throws \Exception
         */
        function getById(int $id): AcceptOptionsInterface;
        /**
         * Get Accept Options by Order
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface $order
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface
         * @throws \Exception
         */
        function getByOrder(OrderInterface $order): AcceptOptionsInterface;
        /**
         * Delete Accept Options
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface $acceptOptions
         * @return bool
         */
        function delete(AcceptOptionsInterface $acceptOptions): bool;
        /**
         * Save Accept Options
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface $acceptOptions
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface
         */
        function save(AcceptOptionsInterface $acceptOptions): AcceptOptionsInterface;
    }
?>