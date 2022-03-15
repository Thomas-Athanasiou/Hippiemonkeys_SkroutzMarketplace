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

    use Magento\Framework\Api\SearchCriteriaInterface,

        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterface;

    interface LineItemRepositoryInterface
    {

        /**
         * Gets Line Item from the persistent storage by its Local Id
         *
         * @api
         *
         * @param int $localId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface
         */
        function getByLocalId(int $localId): LineItemInterface;

        /**
         * Gets Line Item from the persistent storage by its Skroutz Id
         *
         * @api
         *
         * @param int $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterface
         */
        function getBySkroutzId(string $skroutzId) : LineItemInterface;

        /**
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria The search criteria.
         *
         * @return \Magento\Sales\Api\Data\OrderItemSearchResultInterface Order item search result interface.
         */
        function getList(SearchCriteriaInterface $searchCriteria);

        /**
         * Deletes Line Item  from the persistent storage
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterface $lineItem
         *
         * @return bool
         */
        function delete(LineItemInterface $lineItem): bool;

        function save(LineItemInterface $lineItem): LineItemInterface;
    }
?>