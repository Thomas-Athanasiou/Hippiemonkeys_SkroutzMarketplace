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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface;

    interface LineItemRejectionReasonRepositoryInterface
    {
        /**
         * Get Line Item Rejection Reason by id
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function getById(int $localId): LineItemRejectionReasonInterface;

        /**
         * Deletes Line Item Rejection Reason
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoicedetails
         *
         * @return bool
         */
        function delete(LineItemRejectionReasonInterface $lineItemRejectionReason): bool;

        /**
         * Saves Line Item Rejection Reason
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoicedetails
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function save(LineItemRejectionReasonInterface $lineItemRejectionReason): LineItemRejectionReasonInterface;
    }
?>