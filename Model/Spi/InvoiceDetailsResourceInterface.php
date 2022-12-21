<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * InvoiceDetails Resource interface
     */
    interface InvoiceDetailsResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_ID = 'id',
            FIELD_COMPANY = 'company',
            FIELD_PROFESSION = 'profession',
            FIELD_DOY = 'doy',
            FIELD_VAT_NUMBER = 'vat_number',
            FIELD_VAT_EXCLUSION_REQUESTED = 'vat_exclusion_requested',
            FIELD_ADDRESS_ID = 'address_id',
            FIELD_VAT_EXCLUSION_REPRESENTATIVE_ID = 'vat_exclusion_representative_id';

        /**
         * Saves Invoice Details data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoiceDetails
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsResourceInterface
         */
        function saveInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): InvoiceDetailsResourceInterface;

        /**
         * Loads a Invoice Details by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoiceDetails
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsResourceInterface
         */
        function loadInvoiceDetailsById(InvoiceDetailsInterface $invoiceDetails, $id): InvoiceDetailsResourceInterface;

        /**
         * Deletes the Invoice Details
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoiceDetails
         *
         * @return bool
         */
        function deleteInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): bool;
    }
?>