<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterface;

    interface AcceptOptionsPickupWindowRelationRepositoryInterface
    {
        /**
         * Gets Accept Options - Pickup Window Relation by ID
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface
         */
        function getById($id): AcceptOptionsPickupWindowRelationInterface;

        /**
         * Gets Accept Options - Pickup Window Relation by Accept Options and Pickup Window
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface $acceptOptions
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface $pickupWindow
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface
         */
        function getByAcceptOptionsAndPickupWindow(AcceptOptionsInterface $acceptOptions, PickupWindowInterface $pickupWindow) : AcceptOptionsPickupWindowRelationInterface;

        /**
         * Gets List by Search Criteria
         *
         * @api
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): AcceptOptionsPickupWindowRelationSearchResultInterface;

        /**
         * Deletes Accept Options - Pickup Window relation
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupLocationRelation
         *
         * @return bool
         */
        function delete(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation): bool;

        /**
         * Saves Accept Options - Pickup Window Relation
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface
         */
        function save(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation): AcceptOptionsPickupWindowRelationInterface;
    }
?>