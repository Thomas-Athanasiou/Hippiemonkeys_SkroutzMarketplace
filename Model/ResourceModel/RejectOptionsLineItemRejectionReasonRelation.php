<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsLineItemRejectionReasonRelationResourceInterface;

    class RejectOptionsLineItemRejectionReasonRelation
    extends AbstractResource
    implements RejectOptionsLineItemRejectionReasonRelationResourceInterface
    {
        public const
            FIELD_ID = 'id',
            FIELD_REJECT_OPTIONS_ID = 'reject_options_id',
            FIELD_LINE_ITEM_REJECTION_REASON_ID = 'line_item_rejection_reason_id';

        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzMarketplace_rejectoptionslirr_r';

        /**
         * {@inheritdoc}
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function saveRejectOptionsLineItemRejectionReasonRelation(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): RejectOptionsLineItemRejectionReasonRelationResourceInterface
        {
            return $this->saveModel($rejectOptionsLineItemRejectionReasonRelation);
        }

        /**
         * {@inheritdoc}
         */
        public function loadRejectOptionsLineItemRejectionReasonRelationById(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation, $id): RejectOptionsLineItemRejectionReasonRelationResourceInterface
        {
            return $this->loadModelById($rejectOptionsLineItemRejectionReasonRelation, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteRejectOptionsLineItemRejectionReasonRelation(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): bool
        {
            return $this->deleteModel($rejectOptionsLineItemRejectionReasonRelation);
        }
    }
?>