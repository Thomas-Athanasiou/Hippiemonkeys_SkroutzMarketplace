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

    class AcceptOptionsPickupWindowRelation
    extends AbstractDb
    {
        public const
            FIELD_ID                = 'id',
            FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id',
            FIELD_PICKUP_WINDOW_ID  = 'pickup_window_id';

        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzsmartcart_acceptoptionspickupwindow_r';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        public function loadByAcceptOptionsIdAndPickupWindow(AbstractModel $object, int $acceptOptionsId, int $pickupWindowId)
        {
            $idField = self::FIELD_ID;

            $acceptOptionsIdField       = self::FIELD_ACCEPT_OPTIONS_ID;
            $acceptOptionsIdPlaceholder = ':'.$acceptOptionsIdField;

            $pickupWindowField          = self::FIELD_PICKUP_WINDOW_ID;
            $pickupWindowPlaceholder    = ':'.$pickupWindowField;

            $connection = $this->getConnection();
            return $this->load(
                $object,
                $connection->fetchOne(
                    $connection->select()
                        ->from($this->getMainTable(), $idField)
                        ->where($acceptOptionsIdField . '=' . $acceptOptionsIdPlaceholder . ' AND ' . $pickupWindowField . '=' . $pickupWindowPlaceholder),
                    [
                        $acceptOptionsIdPlaceholder => $acceptOptionsId,
                        $pickupWindowPlaceholder    => $pickupWindowId
                    ]
                ),
                $idField
            );
        }
    }
?>