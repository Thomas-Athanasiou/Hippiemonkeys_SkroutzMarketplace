<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
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
         * @param mixed $id
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface
         * @throws \Exception
         */
        function getById(int $ιd): InvoiceDetailsInterface;
        /**
         * Delete Invoice Details
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface $invoicedetails
         * @return bool
         */
        function delete(InvoiceDetailsInterface $invoicedetails): bool;
        /**
         * Save Invoice Details
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface $invoicedetails
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface
         */
        function save(InvoiceDetailsInterface $invoicedetails): InvoiceDetailsInterface;
    }
?>