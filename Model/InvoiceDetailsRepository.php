<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\InvoiceDetailsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\InvoiceDetails as ResourceModel;

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
        public function getById(int $id) : InvoiceDetailsInterface
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