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

    class Size
    extends AbstractDb
    {
        public const
            FIELD_ID            = 'id',
            FIELD_LABEL         = 'label',
            FIELD_VALUE         = 'value',
            FIELD_SHOP_VALUE    = 'shop_value';

        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzsmartcart_size';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }
    }
?>