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

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface;

    interface LineItemRejectionReasonRepositoryInterface
    {
        function getByLocalId(int $localId): LineItemRejectionReasonInterface;

        /**
         * Get LineItemRejectionReason skroutz id
         *
         * @param int $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface
         */
        function getBySkroutzId(int $skroutzId): LineItemRejectionReasonInterface;

        function delete(LineItemRejectionReasonInterface $lineItemRejectionReason): bool;

        function save(LineItemRejectionReasonInterface $lineItemRejectionReason): LineItemRejectionReasonInterface;
    }
?>