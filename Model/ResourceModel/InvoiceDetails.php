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

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Exception\NoSuchEntityException,
        Magento\Framework\Model\ResourceModel\Db\Context,
        Hippiemonkeys\Core\Model\ResourceModel\AbstractResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\InvoiceDetailsResourceInterface;

    class InvoiceDetails
    extends AbstractResource
    implements InvoiceDetailsResourceInterface
    {
        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzmarketplace_invoicedetails';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface $vatExclusionRepresentativeRepository
         * @param string|null $connectionName
         */
        public function __construct(
            Context $context,
            VatExclusionRepresentativeRepositoryInterface $vatExclusionRepresentativeRepository,
            $connectionName = null
        )
        {
            parent::__construct($context, $connectionName);
            $this->vatExclusionRepresentativeRepository = $vatExclusionRepresentativeRepository;
        }

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        /**
         * @inheritdoc
         */
        public function saveInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): self
        {
            return $this->saveModel($invoiceDetails);
        }

        /**
         * @inheritdoc
         */
        public function loadInvoiceDetailsById(InvoiceDetailsInterface $invoiceDetails, $id): self
        {
            return $this->loadModelById($invoiceDetails, $id);
        }

        /**
         * @inheritdoc
         */
        public function deleteInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): bool
        {
            return $this->deleteModel($invoiceDetails);
        }

        /**
         * Vat Exclusion Representative Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface $vatExclusionRepresentativeRepository
         */
        private $vatExclusionRepresentativeRepository;

        /**
         * Gets Vat Exclusion Representative Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface
         */
        protected final function getVatExclusionRepresentativeRepository(): VatExclusionRepresentativeRepositoryInterface
        {
            return $this->vatExclusionRepresentativeRepository;
        }
    }
?>