<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface;

    interface RejectOptionsRepositoryInterface
    {
        function getById(int $id): RejectOptionsInterface;
        /**
         * Get Reject Options by Order
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface $order
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface
         * @throws \Exception
         */
        function getByOrder(OrderInterface $order): RejectOptionsInterface;
        function delete(RejectOptionsInterface $rejectOptions): bool;
        function save(RejectOptionsInterface $rejectOptions): RejectOptionsInterface;
    }
?>