<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package HippiemonkeysskroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Exception\NoSuchEntityException,
        Magento\Framework\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsManagementInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface;

    class InvoiceDetailsManagement
    implements InvoiceDetailsManagementInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface $invoiceDetailsRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface $vatExclusionRepresentativeRepository
         */
        public function __construct(
            InvoiceDetailsRepositoryInterface $invoiceDetailsRepository,
            VatExclusionRepresentativeRepositoryInterface $vatExclusionRepresentativeRepository
        )
        {
            $this->invoiceDetailsRepository = $invoiceDetailsRepository;
            $this->vatExclusionRepresentativeRepository = $vatExclusionRepresentativeRepository;
        }

        /**
         * @inheritdoc
         */
        public function saveInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): void
        {
            $this->syncInvoiceDetails($invoiceDetails);
            $this->getInvoiceDetailsRepository()->save($invoiceDetails);
        }

        /**
         * @inheritdoc
         */
        public function syncInvoiceDetails(InvoiceDetailsInterface $invoiceDetails): void
        {
            $vatExclusionRepresentative = $invoiceDetails->getVatExclusionRepresentative();
            if($vatExclusionRepresentative !== null)
            {
                $vatExclusionRepresentativeRepository = $this->getVatExclusionRepresentativeRepository();
                if($vatExclusionRepresentative->getId() === null)
                {
                    try
                    {
                        $vatExclusionRepresentative->setId(
                            $vatExclusionRepresentativeRepository->getByIdTypeAndIdNumber(
                                $vatExclusionRepresentative->getIdType(),
                                $vatExclusionRepresentative->getIdNumber()
                            )
                            ->getId()
                        );
                    }
                    catch(NoSuchEntityException)
                    {
                        if ($vatExclusionRepresentative instanceof AbstractModel)
                        {
                            $vatExclusionRepresentative->isObjectNew(true);
                        }
                    }
                }

                $vatExclusionRepresentativeRepository->save($vatExclusionRepresentative);

                $invoiceDetails->setVatExclusionRepresentative($vatExclusionRepresentative);
            }
        }

        /**
         * Invoice Details Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface
         */
        private $invoiceDetailsRepository;

        /**
         * Gets Invoice Details Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface
         */
        protected function getInvoiceDetailsRepository(): InvoiceDetailsRepositoryInterface
        {
            return $this->invoiceDetailsRepository;
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
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface
         */
        protected function getVatExclusionRepresentativeRepository(): VatExclusionRepresentativeRepositoryInterface
        {
            return $this->vatExclusionRepresentativeRepository;
        }
    }
?>