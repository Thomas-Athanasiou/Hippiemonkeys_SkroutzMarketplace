<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface;

    interface InvoiceDetailsManagementInterface
    {
        /**
         * Saves an Invoice Details and its dependencies
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoiceDetails
         *
         * @return void
         */
        function saveInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): void;

        /**
         * Synchronizes Invoice Details with the persistent storage data
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoiceDetails
         *
         * @return void
         */
        function syncInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): void;
    }
?>