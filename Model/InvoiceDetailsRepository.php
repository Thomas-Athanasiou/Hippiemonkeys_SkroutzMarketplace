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
    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\InvoiceDetails as ResourceModel;

    class InvoiceDetailsRepository
    implements InvoiceDetailsRepositoryInterface
    {
        public function __construct(
            ResourceModel $resourceModel,
            InvoiceDetailsInterfaceFactory $invoiceDetailsFactory
        )
        {
            $this->_resourceModel           = $resourceModel;
            $this->_invoiceDetailsFactory   = $invoiceDetailsFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : InvoiceDetailsInterface
        {
            $invoiceDetails = $this->getInvoiceDetailsFactory()->create();
            $this->getResourceModel()->load($invoiceDetails, $id, ResourceModel::FIELD_ID);
            if (!$invoiceDetails->getId())
            {
                throw new NoSuchEntityException(
                    __('The InvoiceDetails with id "%1" that was requested doesn\'t exist. Verify the invoiceDetails and try again.', $id)
                );
            }
            return $invoiceDetails;
        }

        /**
         * @inheritdoc
         */
        public function save(InvoiceDetailsInterface $invoiceDetails) : InvoiceDetailsInterface
        {
            $this->getResourceModel()->save($invoiceDetails);
            return $invoiceDetails;
        }

        /**
         * @inheritdoc
         */
        public function delete(InvoiceDetailsInterface $invoiceDetails) : bool
        {
            $this->getResourceModel()->delete($invoiceDetails);
            return $invoiceDetails->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_invoiceDetailsFactory;
        protected function getInvoiceDetailsFactory() : InvoiceDetailsInterfaceFactory
        {
            return $this->_invoiceDetailsFactory;
        }
    }
?>