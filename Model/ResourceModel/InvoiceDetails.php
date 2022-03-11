<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel;

    use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

    class InvoiceDetails
    extends AbstractDb
    {
        public const
            FIELD_ID                                = 'id',
            FIELD_COMPANY                           = 'company',
            FIELD_PROFESSION                        = 'profession',
            FIELD_DOY                               = 'doy',
            FIELD_VAT_NUMBER                        = 'vat_number',
            FIELD_VAT_EXCLUSION_REQUESTED           = 'vat_exclusion_requested',
            FIELD_ADDRESS_ID                        = 'address_id',
            FIELD_VAT_EXCLUSION_REPRESENTATIVE_ID   = 'vat_exclusion_representative_id';

        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzsmartcart_invoicedetails';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }
    }
?>