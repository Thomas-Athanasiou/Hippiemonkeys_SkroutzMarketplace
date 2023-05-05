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

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\InvoiceDetailsResourceInterface as ResourceInterface;

    class InvoiceDetailsRepository
    implements InvoiceDetailsRepositoryInterface
    {
        public function __construct(
            ResourceInterface $resource,
            InvoiceDetailsInterfaceFactory $invoiceDetailsFactory
        )
        {
            $this->_resource = $resource;
            $this->_invoiceDetailsFactory = $invoiceDetailsFactory;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : InvoiceDetailsInterface
        {
            $invoiceDetails = $this->getInvoiceDetailsFactory()->create();
            $this->getResource()->loadInvoiceDetailsById($invoiceDetails, $id);
            if (!$invoiceDetails->getId())
            {
                throw new NoSuchEntityException(
                    __('The InvoiceDetails with id "%1" that was requested doesn\'t exist. Verify the invoiceDetails and try again.', $id)
                );
            }
            return $invoiceDetails;
        }

        /**
         * {@inheritdoc}
         */
        public function save(InvoiceDetailsInterface $invoiceDetails) : InvoiceDetailsInterface
        {
            $this->getResource()->saveInvoiceDetails($invoiceDetails);
            return $invoiceDetails;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(InvoiceDetailsInterface $invoiceDetails) : bool
        {
            return $this->getResource()->deleteInvoiceDetails($invoiceDetails);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\InvoiceDetailsResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\InvoiceDetailsResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Invoice Details Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterfaceFactory $_invoiceDetailsFactory
         */
        private $_invoiceDetailsFactory;

        /**
         * Gets Invoice Details Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterfaceFactory
         */
        protected function getInvoiceDetailsFactory() : InvoiceDetailsInterfaceFactory
        {
            return $this->_invoiceDetailsFactory;
        }
    }
?>