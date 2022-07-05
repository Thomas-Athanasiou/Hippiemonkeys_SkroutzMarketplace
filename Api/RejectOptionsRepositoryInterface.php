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

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface;

    interface RejectOptionsRepositoryInterface
    {
        function getById($id): RejectOptionsInterface;

        /**
         * Get Reject Options by Order
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface $order
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface
         */
        function getByOrder(OrderInterface $order): RejectOptionsInterface;

        function delete(RejectOptionsInterface $rejectOptions): bool;

        function save(RejectOptionsInterface $rejectOptions): RejectOptionsInterface;
    }
?>