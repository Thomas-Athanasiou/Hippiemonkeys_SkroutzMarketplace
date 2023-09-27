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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\CustomerResourceInterface as ResourceInterface;

    class Customer
    extends AbstractModel
    implements CustomerInterface
    {
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
            $this->address = null;
        }

        /**
         * @inheritdoc
         */
        public function setId($id)
        {
            return $this->setData(ResourceInterface::FIELD_ID, $id);
        }

        /**
         * @inheritdoc
         */
        public function getSkroutzId(): string
        {
            return $this->getData(ResourceInterface::FIELD_SKROUTZ_ID);
        }

        /**
         * @inheritdoc
         */
        public function setSkroutzId(string $skroutzId): self
        {
            return $this->setData(ResourceInterface::FIELD_SKROUTZ_ID, $skroutzId);
        }

        /**
         * @inheritdoc
         */
        public function getFirstName(): string
        {
            return $this->getData(ResourceInterface::FIELD_FIRST_NAME);
        }

        /**
         * @inheritdoc
         */
        public function setFirstName(string $firstName): self
        {
            return $this->setData(ResourceInterface::FIELD_FIRST_NAME, $firstName);
        }

        /**
         * @inheritdoc
         */
        public function getLastName(): string
        {
            return $this->getData(ResourceInterface::FIELD_LAST_NAME);
        }

        /**
         * @inheritdoc
         */
        public function setLastName(string $lastName): self
        {
            return $this->setData(ResourceInterface::FIELD_LAST_NAME, $lastName);
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
        public function setAddress(?AddressInterface $address): self
        {
            $this->address = $address;
            return $this->setData(ResourceInterface::FIELD_ADDRESS_ID, ($address === null ? $address : $address->getId()));
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