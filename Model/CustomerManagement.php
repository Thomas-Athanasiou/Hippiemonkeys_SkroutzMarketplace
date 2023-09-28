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
        Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\CustomerManagementInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface;

    class CustomerManagement
    implements CustomerManagementInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface $customerRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface $addressRepository
         */
        public function __construct(
            CustomerRepositoryInterface $customerRepository,
            AddressRepositoryInterface $addressRepository
        )
        {
            $this->customerRepository = $customerRepository;
            $this->addressRepository = $addressRepository;
        }

        /**
         * @inheritdoc
         */
        public function saveCustomer(CustomerInterface $customer): void
        {
            $this->syncCustomer($customer);
            $this->getCustomerRepository()->save($customer);
        }

        /**
         * @inheritdoc
         */
        public function syncCustomer(CustomerInterface $customer): void
        {
            if($customer !== null)
            {
                $address = $customer->getAddress();
                $customerRepository = $this->getCustomerRepository();

                try
                {
                    $persistentCustomer = $customerRepository->getBySkroutzId($customer->getSkroutzId());
                    $customer->setId($persistentCustomer->getId());
                    $persistentAddress = $persistentCustomer->getAddress();
                    if($persistentAddress !== null && $address !== null)
                    {
                        $address->setId($persistentAddress->getId());
                    }
                }
                catch(NoSuchEntityException)
                {
                    /** Customer doesn't exist in the first place */
                }

                if($address !== null)
                {
                    $this->getAddressRepository()->save($address);
                }

                $customer->setAddress($address);
                $customerRepository->save($customer);
            }
        }

        /**
         * Invoice Details Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface
         */
        private $customerRepository;

        /**
         * Gets Invoice Details Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface
         */
        protected function getCustomerRepository(): CustomerRepositoryInterface
        {
            return $this->customerRepository;
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
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface
         */
        protected function getAddressRepository(): AddressRepositoryInterface
        {
            return $this->addressRepository;
        }
    }
?>