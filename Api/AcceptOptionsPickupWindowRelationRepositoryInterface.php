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

    use Magento\Framework\Api\SearchCriteriaInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterface;

    interface AcceptOptionsPickupWindowRelationRepositoryInterface
    {
        /**
         * Gets Accept Options - Pickup Window Relation by ID
         *
         * @api
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterface
         */
        function getById($id): AcceptOptionsPickupWindowRelationInterface;

        function getByAcceptOptionsAndPickupWindow(AcceptOptionsInterface $acceptOptions, PickupWindowInterface $pickupWindow) : AcceptOptionsPickupWindowRelationInterface;

        function getList(SearchCriteriaInterface $searchCriteria): AcceptOptionsPickupWindowRelationSearchResultInterface;

        /**
         * Deletes Accept Options - Pickup Window relation
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupLocationRelation
         *
         * @return bool
         */
        function delete(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation): bool;

        /**
         * Saves Accept Options - Pickup Window Relation
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterface
         */
        function save(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation): AcceptOptionsPickupWindowRelationInterface;
    }
?>