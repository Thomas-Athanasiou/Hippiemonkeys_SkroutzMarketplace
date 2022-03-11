<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel;

    use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

    class VatExclusionRepresentative
    extends AbstractDb
    {
        public const
            FIELD_ID        = 'id',
            FIELD_ID_TYPE   = 'id_type',
            FIELD_ID_NUMBER = 'id_number',
            FIELD_OTP       = 'otp';

        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzsmartcart_vatexlusionrepresentative';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }
    }
?>