<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel;

    use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

    class Customer
    extends AbstractDb
    {
        public const
            FIELD_LOCAL_ID      = 'id',
            FIELD_SKROUTZ_ID    = 'skroutz_id',
            FIELD_FIRST_NAME    = 'first_name',
            FIELD_LAST_NAME     = 'last_name',
            FIELD_ADDRESS_ID    = 'address_id';

        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzsmartcart_customer';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_LOCAL_ID);
        }
    }
?>