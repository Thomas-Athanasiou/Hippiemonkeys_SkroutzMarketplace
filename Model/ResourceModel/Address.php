<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel;

    use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

    class Address
    extends AbstractDb
    {
        public const
            FIELD_ID                            = 'id',
            FIELD_STREET_NAME                   = 'street_name',
            FIELD_STREET_NUMBER                 = 'street_number',
            FIELD_ZIP                           = 'zip',
            FIELD_CITY                          = 'city',
            FIELD_REGION                        = 'region',
            FIELD_COUNTRY_CODE                  = 'country_code',
            FIELD_PICKUP_FROM_COLLECTION_POINT  = 'pickup_from_collection_point',
            FIELD_COLLECTION_POINT_ADDRESS      = 'collection_point_address';

        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzsmartcart_address';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }
    }
?>