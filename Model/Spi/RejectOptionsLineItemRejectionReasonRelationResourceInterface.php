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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface RejectOptionsLineItemRejectionReasonRelationResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_REJECT_OPTIONS_ID = 'reject_options_id',
            FIELD_LINE_ITEM_REJECTION_REASON_ID = 'line_item_rejection_reason_id';

        /**
         * Saves RejectOptionsLineItemRejectionReasonRelation data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationResourceInterface
         */
        function saveRejectOptionsLineItemRejectionReasonRelation(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): RejectOptionsLineItemRejectionReasonRelationResourceInterface;

        /**
         * Load a RejectOptionsLineItemRejectionReasonRelation by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationResourceInterface
         */
        function loadRejectOptionsLineItemRejectionReasonRelationById(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation, $id): RejectOptionsLineItemRejectionReasonRelationResourceInterface;

        /**
         * Delete the RejectOptionsLineItemRejectionReasonRelation
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation
         *
         * @return bool
         */
        function deleteRejectOptionsLineItemRejectionReasonRelation(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): bool;
    }
?>