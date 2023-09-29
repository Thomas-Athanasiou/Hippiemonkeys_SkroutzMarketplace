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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface;

    interface LineItemRejectionReasonRepositoryInterface
    {
        /**
         * Get Line Item Rejection Reason by id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function getById($id): LineItemRejectionReasonInterface;

        /**
         * Get Line Item Rejection Reason by Skroutz Id
         *
         * @access public
         *
         * @param int $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function getBySkroutzId(int $skroutzId) : LineItemRejectionReasonInterface;

        /**
         * Deletes Line Item Rejection Reason
         *
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
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface $invoicedetails
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function save(LineItemRejectionReasonInterface $lineItemRejectionReason): LineItemRejectionReasonInterface;
    }
?>