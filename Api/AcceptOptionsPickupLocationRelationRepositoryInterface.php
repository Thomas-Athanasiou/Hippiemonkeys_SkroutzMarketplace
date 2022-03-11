<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterface;

    interface AcceptOptionsPickupLocationRelationRepositoryInterface
    {
        /**
         * Gets Accept Options and Pickup Location Relation by id
         * @param int $id
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationInterface
         */
        function getById(int $id): AcceptOptionsPickupLocationRelationInterface;

        /**
         * Gets Accept Options and Pickup Location Relation by Accept Options and Pickup Location
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface $acceptOptions
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationInterface
         */
        function getByAcceptOptionsAndPickupLocation(AcceptOptionsInterface $acceptOptions, PickupLocationInterface $pickupLocation) : AcceptOptionsPickupLocationRelationInterface;

        /**
         * Gets list by search criteria provided
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): AcceptOptionsPickupLocationRelationSearchResultInterface;

        /**
         * Deletes Accept Options - Pickup Location relation
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation
         *
         * @return bool
         */
        function delete(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation): bool;

        /**
         * Saves Accept Options - Pickup Location relation
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationInterface
         */
        function save(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation): AcceptOptionsPickupLocationRelationInterface;
    }
?>