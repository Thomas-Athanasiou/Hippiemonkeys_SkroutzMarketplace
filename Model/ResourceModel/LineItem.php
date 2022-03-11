<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel;

    use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

    class LineItem
    extends AbstractDb
    {
        public const
            FIELD_LOCAL_ID                      = 'id',
            FIELD_SKROUTZ_ID                    = 'skroutz_id',
            FIELD_SIZE                          = 'size',
            FIELD_SHOPUID                       = 'shopuid',
            FIELD_PRODUCT_NAME                  = 'product_name',
            FIELD_QUANTITY                      = 'quantity',
            FIELD_UNIT_PRICE                    = 'unit_price',
            FIELD_TOTAL_PRICE                   = 'total_price',
            FIELD_PRICE_INCLUDES_VAT            = 'price_includes_vat',
            FIELD_EAN                           = 'ean',
            FIELD_ISLAND_VAT_DISCOUNT_APPLIED   = 'island_vat_discount_applied',
            FIELD_EXTRA_INFO                    = 'extra_info',
            FIELD_ORDER_ID                      = 'order_id';

        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzsmartcart_lineitem';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_LOCAL_ID);
        }
    }
?>