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

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel;

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\Db\AbstractDb;

    class RejectOptionsLineItemRejectionReasonRelation
    extends AbstractDb
    {
        public const
            FIELD_ID                            = 'id',
            FIELD_REJECT_OPTIONS_ID             = 'reject_options_id',
            FIELD_LINE_ITEM_REJECTION_REASON_ID = 'line_item_rejection_reason_id';

        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzsmartcart_rejectoptionslirr_r';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        public function loadByRejectOptionsIdAndLineItemRejectionReason(AbstractModel $object, int $rejectOptionsId, int $lineItemRejectionReasonId)
        {
            $idField = self::FIELD_ID;

            $rejectOptionsIdField       = self::FIELD_REJECT_OPTIONS_ID;
            $rejectOptionsIdPlaceholder = ':'.$rejectOptionsIdField;

            $lineItemRejectionReasonField       = self::FIELD_LINE_ITEM_REJECTION_REASON_ID;
            $lineItemRejectionReasonPlaceholder = ':'.$lineItemRejectionReasonField;

            $connection = $this->getConnection();
            return $this->load(
                $object,
                $connection->fetchOne(
                    $connection->select()
                        ->from($this->getMainTable(), $idField)
                        ->where($rejectOptionsIdField . '=' . $rejectOptionsIdPlaceholder . ' AND ' . $lineItemRejectionReasonField . '=' . $lineItemRejectionReasonPlaceholder),
                    [
                        $rejectOptionsIdPlaceholder         => $rejectOptionsId,
                        $lineItemRejectionReasonPlaceholder => $lineItemRejectionReasonId
                    ]
                ),
                $idField
            );
        }
    }
?>