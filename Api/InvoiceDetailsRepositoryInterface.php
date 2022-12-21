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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface;

    interface InvoiceDetailsRepositoryInterface
    {
        /**
         * Get Invoice Details by id
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function getById($id): InvoiceDetailsInterface;

        /**
         * Delete Invoice Details
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoicedetails
         *
         * @return bool
         */
        function delete(InvoiceDetailsInterface $invoicedetails): bool;

        /**
         * Saves Invoice Details
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoicedetails
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function save(InvoiceDetailsInterface $invoicedetails): InvoiceDetailsInterface;
    }
?>