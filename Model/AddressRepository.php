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
        Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AddressResourceInterface as ResourceInterface;

    class AddressRepository
    implements AddressRepositoryInterface
    {
        /**
         * Id Index property
         *
         * @access protected
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface[]
         */
        protected $_idCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AddressResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterfaceFactory $addressFactory
         */
        public function __construct(
            ResourceInterface $resource,
            AddressInterfaceFactory $addressFactory
        )
        {
            $this->_resource = $resource;
            $this->_addressFactory  = $addressFactory;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : AddressInterface
        {
            $address = $this->_idCache[$id] ?? null;
            if($address === null)
            {
                $address = $this->getAddressFactory()->create();
                $this->getResource()->loadAddressById($address, $id);
                if ($address->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Address with id "%1" that was requested doesn\'t exist. Verify the address and try again.', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $address;
                }
            }

            return $address;
        }

        /**
         * {@inheritdoc}
         */
        public function save(AddressInterface $address): AddressInterface
        {
            $this->_idCache[$address->getId()] = $address;
            $this->getResource()->saveAddress($address);
            return $address;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(AddressInterface $address): bool
        {
            return $this->getResource()->deleteAddress($address);
        }

        /**
         * Resource Model property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AddressResourceInterface
         */
        private $_resource;

        /**
         * Gets Resource Model
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AddressResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Address Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterfaceFactory
         */
        private $_addressFactory;

        /**
         * Gets Address Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterfaceFactory
         */
        protected function getAddressFactory() : AddressInterfaceFactory
        {
            return $this->_addressFactory;
        }
    }
?>