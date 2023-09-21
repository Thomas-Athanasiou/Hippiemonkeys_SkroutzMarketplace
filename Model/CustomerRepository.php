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
        Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\CustomerResourceInterface as ResourceInterface;

    class CustomerRepository
    implements CustomerRepositoryInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\CustomerResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterfaceFactory $customerFactory
         */
        public function __construct(
            ResourceInterface $resource,
            CustomerInterfaceFactory $customerFactory
        )
        {
            $this->_resource = $resource;
            $this->_customerFactory = $customerFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById(int $id) : CustomerInterface
        {
            $customer = $this->getCustomerFactory()->create();
            $this->getResource()->loadCustomerById($customer, $id);
            if ($customer->getId() === null)
            {
                throw new NoSuchEntityException(
                    __('The Customer with Id "%1" that was requested doesn\'t exist. Verify the customer and try again.', $id)
                );
            }
            return $customer;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(string $skroutzId) : CustomerInterface
        {
            $customer = $this->getCustomerFactory()->create();
            $this->getResource()->loadCustomerBySkroutzId($customer, $skroutzId);
            if ($customer->getId() === null)
            {
                throw new NoSuchEntityException(
                    __('The Customer with id "%1" that was requested doesn\'t exist. Verify the customer and try again.', $skroutzId)
                );
            }
            return $customer;
        }

        /**
         * @inheritdoc
         */
        public function save(CustomerInterface $customer) : CustomerInterface
        {
            $this->getResource()->saveCustomer($customer);
            return $customer;
        }

        /**
         * @inheritdoc
         */
        public function delete(CustomerInterface $customer) : bool
        {
            return $this->getResource()->deleteCustomer($customer);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\CustomerResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\CustomerResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Customer Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterfaceFactory $_customerFactory
         */
        private $_customerFactory;

        /**
         * Gets Customer Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterfaceFactory
         */
        protected function getCustomerFactory() : CustomerInterfaceFactory
        {
            return $this->_customerFactory;
        }
    }
?>