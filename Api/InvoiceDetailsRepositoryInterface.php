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

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface;

    interface InvoiceDetailsRepositoryInterface
    {
        /**
         * Get Invoice Details by id
         *
         * @api
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface
         */
        function getById($id): InvoiceDetailsInterface;

        /**
         * Delete Invoice Details
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface $invoicedetails
         *
         * @return bool
         */
        function delete(InvoiceDetailsInterface $invoicedetails): bool;

        /**
         * Save Invoice Details
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface $invoicedetails
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface
         */
        function save(InvoiceDetailsInterface $invoicedetails): InvoiceDetailsInterface;
    }
?>