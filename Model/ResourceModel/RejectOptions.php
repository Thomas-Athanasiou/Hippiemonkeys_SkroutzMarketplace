<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel;

    use Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb;

    class RejectOptions
    extends AbstractDb
    {
        public const
            FIELD_ID        = 'id',
            FIELD_ORDER_ID  = 'order_id';

        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzsmartcart_rejectoptions';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }
    }
?>