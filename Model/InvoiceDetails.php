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

    use Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\InvoiceDetailsResourceInterface as ResourceInterface;

    class InvoiceDetails
    extends AbstractModel
    implements InvoiceDetailsInterface
    {
        protected const
            FIELD_VAT_EXCLUSION_REPRESENTATIVE  = 'vat_exclusion_representative';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface $addressRepository
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            AddressRepositoryInterface $addressRepository,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->addressRepository = $addressRepository;
        }

        /**
         * @inheritdoc
         */
        public function getCompany(): string
        {
            return $this->getData(ResourceInterface::FIELD_COMPANY);
        }

        /**
         * @inheritdoc
         */
        public function setCompany(string $company): InvoiceDetails
        {
            return $this->setData(ResourceInterface::FIELD_COMPANY, $company);
        }

        /**
         * @inheritdoc
         */
        public function getProfession(): string
        {
            return $this->getData(ResourceInterface::FIELD_PROFESSION);
        }
        /**
         * @inheritdoc
         */
        public function setProfession(string $profession): InvoiceDetails
        {
            return $this->setData(ResourceInterface::FIELD_PROFESSION, $profession);
        }

        /**
         * @inheritdoc
         */
        public function getDoy(): string
        {
            return $this->getDoy(ResourceInterface::FIELD_DOY);
        }
        /**
         * @inheritdoc
         */
        public function setDoy(string $doy): InvoiceDetails
        {
            return $this->setData(ResourceInterface::FIELD_DOY, $doy);
        }

        /**
         * @inheritdoc
         */
        public function getVatNumber(): string
        {
            return $this->getData(ResourceInterface::FIELD_VAT_NUMBER);
        }

        /**
         * @inheritdoc
         */
        public function setVatNumber(string $vatNumber): InvoiceDetails
        {
            return $this->setData(ResourceInterface::FIELD_VAT_NUMBER, $vatNumber);
        }


        /**
         * Address property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface $address
         */
        private $address;

        /**
         * @inheritdoc
         */
        public function getAddress(): AddressInterface
        {
            $address = $this->address;
            if($address === null)
            {
                $addressId = $this->getData(ResourceInterface::FIELD_ADDRESS_ID);
                if($addressId !== null)
                {
                    $address = $this->getAddressRepository()->getById($addressId);
                    $this->address = $address;
                }
            }
            return $address;
        }

        /**
         * @inheritdoc
         */
        public function setAddress(?AddressInterface $address): InvoiceDetails
        {
            $this->address = $address;
            return $this->setData(ResourceInterface::FIELD_ADDRESS_ID, $address ? $address->getId() : null);
        }

        /**
         * @inheritdoc
         */
        public function getVatExclusionRequested(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_VAT_EXCLUSION_REQUESTED);
        }

        /**
         * @inheritdoc
         */
        public function setVatExclusionRequested(bool $vatExclusionRequested): InvoiceDetails
        {
            return $this->setData(ResourceInterface::FIELD_VAT_EXCLUSION_REQUESTED, $vatExclusionRequested);
        }

        /**
         * @inheritdoc
         */
        public function getVatExclusionRepresentative(): VatExclusionRepresentativeInterface
        {
            return $this->getData(self::FIELD_VAT_EXCLUSION_REPRESENTATIVE);
        }

        /**
         * @inheritdoc
         */
        public function setVatExclusionRepresentative(VatExclusionRepresentativeInterface $vatExclusionRepresentative)
        {
            return $this->setData(self::FIELD_VAT_EXCLUSION_REPRESENTATIVE, $vatExclusionRepresentative);
        }

        /**
         * Address Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface $addressRepository
         */
        private $addressRepository;

        /**
         * Gets Address Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface
         */
        protected final function getAddressRepository(): AddressRepositoryInterface
        {
            return $this->addressRepository;
        }
    }
?>