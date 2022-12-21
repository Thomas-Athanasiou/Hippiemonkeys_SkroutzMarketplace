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
        Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Address as ResourceModel;

    class AddressRepository
    implements AddressRepositoryInterface
    {
        /**
         * Id Index property
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface[]
         */
        protected $_idIndex = [];

        /**
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Address $resourceModel
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterfaceFactory $addressFactory
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Address
         */
        private $_resourceModel;

        /**
         * Gets Resource Model
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Address
         */
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        /**
         * Address Factory property
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterfaceFactory
         */
        private $_addressFactory;

        /**
         * Gets Address Factory
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterfaceFactory
         */
        protected function getAddressFactory() : AddressInterfaceFactory
        {
            return $this->_addressFactory;
        }
    }
?>