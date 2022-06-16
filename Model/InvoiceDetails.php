<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,

        Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Magento\Framework\Model\ResourceModel\AbstractResource,
        Magento\Framework\Data\Collection\AbstractDb,

        Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\VatExclusionRepresentativeInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\InvoiceDetails as ResourceModel;

    class InvoiceDetails
    extends AbstractModel
    implements InvoiceDetailsInterface
    {
        protected const
            FIELD_ADDRESS                       = 'address',
            FIELD_VAT_EXCLUSION_REPRESENTATIVE  = 'vat_exclusion_representative';

        public function __construct(
            Context $context,
            Registry $registry,
            AddressRepositoryInterface $addressRepository,
            AbstractResource $resource = null,
            AbstractDb $resourceCollection = null,
            array $data = []
        )
        {
            parent::__construct(
                $context,
                $registry,
                $resource,
                $resourceCollection,
                $data
            );
            $this->_addressRepository = $addressRepository;
        }

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getCompany(): string
        {
            return $this->getData(ResourceModel::FIELD_COMPANY);
        }
        /**
         * @inheritdoc
         */
        public function setCompany(string $company)
        {
            return $this->setData(ResourceModel::FIELD_COMPANY, $company);
        }

        /**
         * @inheritdoc
         */
        public function getProfession(): string
        {
            return $this->getData(ResourceModel::FIELD_PROFESSION);
        }
        /**
         * @inheritdoc
         */
        public function setProfession(string $profession)
        {
            return $this->setData(ResourceModel::FIELD_PROFESSION, $profession);
        }

        /**
         * @inheritdoc
         */
        public function getDoy(): string
        {
            return $this->getDoy(ResourceModel::FIELD_DOY);
        }
        /**
         * @inheritdoc
         */
        public function setDoy(string $doy)
        {
            return $this->setData(ResourceModel::FIELD_DOY, $doy);
        }

        /**
         * @inheritdoc
         */
        public function getVatNumber(): string
        {
            return $this->getData(ResourceModel::FIELD_VAT_NUMBER);
        }
        /**
         * @inheritdoc
         */
        public function setVatNumber(string $vatNumber)
        {
            return $this->setData(ResourceModel::FIELD_VAT_NUMBER, $vatNumber);
        }

        /**
         * @inheritdoc
         */
        public function getAddress()
        {
            $address    = $this->getData(self::FIELD_ADDRESS);
            $addressId  = $this->getData(ResourceModel::FIELD_ADDRESS_ID);
            if($addressId && !$address)
            {
                $address = $this->getAddressRepository()->getById($addressId);
                $this->setAddress($address);
            }
            return $address;
        }
        /**
         * @inheritdoc
         */
        public function setAddress($address)
        {
            $this->setData(ResourceModel::FIELD_ADDRESS_ID, $address ? $address->getId() : null);
            return $this->setData(self::FIELD_ADDRESS, $address);
        }

        /**
         * @inheritdoc
         */
        public function getVatExclusionRequested(): bool
        {
            return $this->getData(ResourceModel::FIELD_VAT_EXCLUSION_REQUESTED);
        }
        /**
         * @inheritdoc
         */
        public function setVatExclusionRequested($vatExclusionRequested)
        {
            return (bool) $this->setData(ResourceModel::FIELD_VAT_EXCLUSION_REQUESTED, $vatExclusionRequested);
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

        private $_addressRepository;
        protected function getAddressRepository(): AddressRepositoryInterface
        {
            return $this->_addressRepository;
        }
    }
?>