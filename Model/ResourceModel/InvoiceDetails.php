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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\InvoiceDetailsResourceInterface;

    class InvoiceDetails
    extends AbstractResource
    implements InvoiceDetailsResourceInterface
    {
        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzmarketplace_invoicedetails';

        /**
         * {@inheritdoc}
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function saveInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): InvoiceDetailsResourceInterface
        {
            return $this->saveModel($invoiceDetails);
        }

        /**
         * {@inheritdoc}
         */
        public function loadInvoiceDetailsById(InvoiceDetailsInterface $invoiceDetails, $id): InvoiceDetailsResourceInterface
        {
            return $this->loadModelById($invoiceDetails, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): bool
        {
            return $this->deleteModel($invoiceDetails);
        }
    }
?>