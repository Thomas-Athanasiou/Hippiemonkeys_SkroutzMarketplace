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
        /**
         * Gets Line Item Rejection Reason from the persistent storage by its Local Id
         *
         * @api
         *
         * @param int $localId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface
         */
        function getByLocalId(int $localId): LineItemRejectionReasonInterface;

        /**
         * Gets Line Item Rejection Reason from the persistent storage by its Skroutz Id
         *
         * @api
         *
         * @param int $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface
         */
        function getBySkroutzId(int $skroutzId): LineItemRejectionReasonInterface;

        /**
         * Deletes Line Item Rejection Reason from the persistent storage
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface $lineItemRejectionReason
         *
         * @return bool
         */
        function delete(LineItemRejectionReasonInterface $lineItemRejectionReason): bool;


        /**
         * Saves Line Item Rejection Reason to the persistent storage
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface $lineItemRejectionReason
         *
         * @return \\Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface
         */
        function save(LineItemRejectionReasonInterface $lineItemRejectionReason): LineItemRejectionReasonInterface;
    }
?>