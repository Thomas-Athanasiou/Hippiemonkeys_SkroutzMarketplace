<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonSearchResultInterface;

    interface LineItemRejectionReasonRepositoryInterface
    {
        function getByLocalId(int $localId): LineItemRejectionReasonInterface;
        /**
         * Get LineItemRejectionReason skroutz id
         *
         * @param mixed $skroutzId
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface
         * @throws \Exception
         */
        function getBySkroutzId(int $skroutzId): LineItemRejectionReasonInterface;
        function delete(LineItemRejectionReasonInterface $lineItemRejectionReason): bool;
        function save(LineItemRejectionReasonInterface $lineItemRejectionReason): LineItemRejectionReasonInterface;
    }
?>