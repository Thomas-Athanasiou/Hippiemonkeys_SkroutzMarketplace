<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Address as ResourceModel;

    class AddressRepository
    implements AddressRepositoryInterface
    {
        /**
         * Id Index property
         *
         * @var \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface[]
         */
        protected $_idIndex = [];

        /**
         * @param \Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Address $resourceModel
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterfaceFactory $addressFactory
         */
        public function __construct(
            ResourceModel $resourceModel,
            AddressInterfaceFactory $addressFactory
        )
        {
            $this->_resourceModel   = $resourceModel;
            $this->_addressFactory  = $addressFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : AddressInterface
        {
            $address = $this->_idIndex[$id] ?? null;
            if(!$address) {
                $address = $this->getAddressFactory()->create();
                $this->getResourceModel()->load($address, $id, ResourceModel::FIELD_ID);
                if (!$address->getId())
                {
                    throw new NoSuchEntityException(
                        __('The Address with id "%1" that was requested doesn\'t exist. Verify the address and try again.', $id)
                    );
                }
                $this->_idIndex[$id] = $address;
            }
            return $address;
        }

        /**
         * @inheritdoc
         */
        public function save(AddressInterface $address): AddressInterface
        {
            $this->getResourceModel()->save($address);
            $this->_idIndex[ $address->getId() ] = $address;
            return $address;
        }

        /**
         * @inheritdoc
         */
        public function delete(AddressInterface $address): bool
        {
            return $this->getResourceModel()->delete($address);
        }

        /**
         * Resource Model property
         *
         * @var \Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Address
         */
        private $_resourceModel;

        /**
         * Gets Resource Model
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Address
         */
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        /**
         * Address Factory property
         *
         * @var \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterfaceFactory
         */
        private $_addressFactory;

        /**
         * Gets Address Factory
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterfaceFactory
         */
        protected function getAddressFactory() : AddressInterfaceFactory
        {
            return $this->_addressFactory;
        }
    }
?>