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

    use Magento\Framework\Exception\NoSuchEntityException,
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
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterfaceFactory $factory
         */
        public function __construct(
            ResourceInterface $resource,
            CustomerInterfaceFactory $factory
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
        }

        /**
         * @inheritdoc
         */
        public function getById(int $id) : CustomerInterface
        {
            $customer = $this->getFactory()->create();
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
            $customer = $this->getFactory()->create();
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
            $resource = $this->getResource();

            if($customer->getId() === null)
            {
                $persistentCustomer = $this->getFactory()->create();
                $resource->loadCustomerBySkroutzId($persistentCustomer, $customer->getSkroutzId());
                $customer->setId($persistentCustomer->getId());
            }

            $resource->saveCustomer($customer);
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\CustomerResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\CustomerResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterfaceFactory
         */
        protected function getFactory() : CustomerInterfaceFactory
        {
            return $this->factory;
        }
    }
?>