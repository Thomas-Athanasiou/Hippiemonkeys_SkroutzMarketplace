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

    use Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb;

    class AcceptOptions
    extends AbstractDb
    {
        public const
            FIELD_ID                = 'id',
            FIELD_ORDER_ID          = 'order_id',
            FIELD_NUMBER_OF_PARCELS = 'number_of_parcels',
            FIELD_PICKUP_LOCATION   = 'pickup_location',
            FIELD_PICKUP_WINDOW     = 'pickup_window';

        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzsmartcart_acceptoptions';

        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }
    }
?>