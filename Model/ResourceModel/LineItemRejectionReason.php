<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel;

    use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

    class LineItemRejectionReason
    extends AbstractDb
    {
        public const
            FIELD_LOCAL_ID                          = 'id',
            FIELD_SKROUTZ_ID                        = 'id',
            FIELD_LABEL                             = 'label',
            FIELD_REQUIRES_AVAILABILITY_QUANTITY    = 'requires_available_quantity';

        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzsmartcart_lineitemrejectionreason';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_LOCAL_ID);
        }
    }
?>