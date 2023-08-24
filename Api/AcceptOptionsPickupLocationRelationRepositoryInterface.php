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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterface;

    /**
     * @api
     */
    interface AcceptOptionsPickupLocationRelationRepositoryInterface
    {
        /**
         * Gets Accept Options and Pickup Location Relation by id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface
         */
        function getById($id): AcceptOptionsPickupLocationRelationInterface;

        /**
         * Gets Accept Options and Pickup Location Relation by Accept Options and Pickup Location
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface $acceptOptions
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface
         */
        function getByAcceptOptionsAndPickupLocation(AcceptOptionsInterface $acceptOptions, PickupLocationInterface $pickupLocation) : AcceptOptionsPickupLocationRelationInterface;

        /**
         * Gets list by search criteria provided
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): AcceptOptionsPickupLocationRelationSearchResultInterface;

        /**
         * Deletes Accept Options Pickup Location relation
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation
         *
         * @return bool
         */
        function delete(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation): bool;

        /**
         * Saves Accept Options Pickup Location relation
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface
         */
        function save(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation): AcceptOptionsPickupLocationRelationInterface;
    }
?>