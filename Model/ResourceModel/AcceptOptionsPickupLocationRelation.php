<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel;

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\Db\AbstractDb;

    class AcceptOptionsPickupLocationRelation
    extends AbstractDb
    {
        public const
            FIELD_ID                    = 'id',
            FIELD_ACCEPT_OPTIONS_ID     = 'accept_options_id',
            FIELD_PICKUP_LOCATION_ID    = 'pickup_location_id';

        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzsmartcart_acceptoptionspickuplocation_r';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }
    
        public function loadByAcceptOptionsIdAndPickupLocation(AbstractModel $object, int $acceptOptionsId, int $pickupLocationId)
        {
            $idField = self::FIELD_ID;

            $acceptOptionsIdField       = self::FIELD_ACCEPT_OPTIONS_ID;
            $acceptOptionsIdPlaceholder = ':'.$acceptOptionsIdField;

            $pickupLocationField        = self::FIELD_PICKUP_LOCATION_ID;
            $pickupLocationPlaceholder  = ':'.$pickupLocationField;

            $connection = $this->getConnection();
            return $this->load(
                $object,
                $connection->fetchOne(
                    $connection->select()
                        ->from($this->getMainTable(), $idField)
                        ->where($acceptOptionsIdField . '=' . $acceptOptionsIdPlaceholder . ' AND ' . $pickupLocationField . '=' . $pickupLocationPlaceholder),
                    [
                        $acceptOptionsIdPlaceholder => $acceptOptionsId,
                        $pickupLocationPlaceholder  => $pickupLocationId
                    ]
                ),
                $idField
            );
        }
    }
?>