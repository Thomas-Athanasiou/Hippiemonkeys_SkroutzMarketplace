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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationSearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface;

    interface RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
    {
        /**
         * Gets Reject Options - Line Item Rejection Reason relation by id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface
         */
        function getById($id): RejectOptionsLineItemRejectionReasonRelationInterface;

        /**
         * Gets List of Reject Options Items
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationSearchResultInterface,
         */
        function getList(SearchCriteriaInterface $searchCriteria): RejectOptionsLineItemRejectionReasonRelationSearchResultInterface;

        /**
         * Gets Reject Options - Line Item Rejection Reason relation by Reject Options and Line Item Rejection Reason
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface
         */
        function getByRejectOptionsAndLineItemRejectionReason(RejectOptionsInterface $rejectOptions, LineItemRejectionReasonInterface $lineItemRejectionReason) : RejectOptionsLineItemRejectionReasonRelationInterface;

        /**
         * Deletes Reject Options - Line Item Rejection Reason relation
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation
         *
         * @return bool
         */
        function delete(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): bool;

        /**
         * Saves Reject Options - Line Item Rejection Reason relation
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface
         */
        function save(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): RejectOptionsLineItemRejectionReasonRelationInterface;
    }
?>