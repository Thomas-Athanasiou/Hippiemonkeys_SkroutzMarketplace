<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,

        Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Magento\Framework\Model\ResourceModel\AbstractResource,
        Magento\Framework\Data\Collection\AbstractDb,

        Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Customer as ResourceModel;

    class Customer
    extends AbstractModel
    implements CustomerInterface
    {
        protected const
            FIELD_ADDRESS = 'address';

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
        public function getLocalId()
        {
            return (int) $this->getData(ResourceModel::FIELD_LOCAL_ID);
        }
        /**
         * @inheritdoc
         */
        public function setLocalId(int $localId)
        {
            return $this->setData(ResourceModel::FIELD_LOCAL_ID, (string) $localId);
        }

        /**
         * @inheritdoc
         */
        public function getSkroutzId(): string
        {
            return $this->getData(ResourceModel::FIELD_SKROUTZ_ID);
        }
        /**
         * @inheritdoc
         */
        public function setSkroutzId(string $skroutzId)
        {
            return $this->setData(ResourceModel::FIELD_SKROUTZ_ID, $skroutzId);
        }

        /**
         * @inheritdoc
         */
        public function getFirstName(): string
        {
            return $this->getData(ResourceModel::FIELD_FIRST_NAME);
        }
        /**
         * @inheritdoc
         */
        public function setFirstName(string $firstName)
        {
            return $this->setData(ResourceModel::FIELD_FIRST_NAME, $firstName);
        }

        /**
         * @inheritdoc
         */
        public function getLastName(): string
        {
            return $this->getData(ResourceModel::FIELD_LAST_NAME);
        }
        /**
         * @inheritdoc
         */
        public function setLastName(string $lastName)
        {
            return $this->setData(ResourceModel::FIELD_LAST_NAME, $lastName);
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
            $this->setData(ResourceModel::FIELD_ADDRESS_ID, ($address ? $address->getId() : $address) );
            return $this->setData(self::FIELD_ADDRESS, $address);
        }

        private $_addressRepository;

        /**
         * Gets Address Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCartWebhook\Api\AddressRepositoryInterface
         */
        protected function getAddressRepository(): AddressRepositoryInterface
        {
            return $this->_addressRepository;
        }
    }
?>