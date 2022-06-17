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

    use Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb;

    class Order
    extends AbstractDb
    {
        public const
            FIELD_ID                        = 'id',
            FIELD_CODE                      = 'code',
            FIELD_STATE                     = 'state',
            FIELD_CUSTOMER_ID               = 'customer_id',
            FIELD_INVOICE                   = 'invoice',
            FIELD_INVOICE_DETAILS_ID        = 'invoice_details_id',
            FIELD_COMMENTS                  = 'comments',
            FIELD_COURIER                   = 'courier',
            FIELD_COURIER_VOUCHER           = 'courier_voucher',
            FIELD_COURIER_TRACKING_CODES    = 'courier_tracking_codes',
            FIELD_LINE_ITEMS                = 'line_items',
            FIELD_ACCEPT_OPTIONS_ID         = 'accept_options_id',
            FIELD_REJECT_OPTIONS_ID         = 'reject_options_id',
            FIELD_CREATED_AT                = 'created_at',
            FIELD_EXPIRES_AT                = 'expires_at',
            FIELD_DISPATCH_UNTIL            = 'dispatch_until',
            FIELD_MAGENTO_ORDER_ID          = 'magento_order_id',
            FIELD_EXPRESS                   = 'express',
            FIELD_CUSTOM                    = 'custom',
            FIELD_GIFT_WRAP                 = 'gift_wrap',
            FIELD_FULFILLED_BY_SKROUTZ      = 'fulfilled_by_skroutz',
            FIELD_FBS_DELIVERY_NOTE         = 'fbs_delivery_note',
            FIELD_REJECTION_INFO_ID         = 'rejection_info_id',
            FIELD_PICKUP_WINDOW_ID          = 'pickup_window_id',
            FIELD_PICKUP_ADDRESS            = 'pickup_address',
            FIELD_NUMBER_OF_PARCELS         = 'number_of_parcels';

        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzsmartcart_order';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }
    }
?>