<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\CustomerRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Customer as ResourceModel;

    class CustomerRepository
    implements CustomerRepositoryInterface
    {
        public function __construct(
            ResourceModel $resourceModel,
            CustomerInterfaceFactory $customerFactory
        )
        {
            $this->_resourceModel   = $resourceModel;
            $this->_customerFactory = $customerFactory;
        }

        /**
         * @inheritdoc
         */
        public function getByLocalId(int $localId) : CustomerInterface
        {
            $customer = $this->getCustomerFactory()->create();
            $this->getResourceModel()->load($customer, $localId, ResourceModel::FIELD_LOCAL_ID);
            if (!$customer->getId())
            {
                throw new NoSuchEntityException(
                    __('The Customer with id "%1" that was requested doesn\'t exist. Verify the customer and try again.', $localId)
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
            $this->getResourceModel()->load($customer, $skroutzId, ResourceModel::FIELD_SKROUTZ_ID);
            if (!$customer->getId())
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
            $this->getResourceModel()->save($customer);
            return $customer;
        }

        /**
         * @inheritdoc
         */
        public function delete(CustomerInterface $customer) : bool
        {
            $this->getResourceModel()->delete($customer);
            return $customer->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_customerFactory;
        protected function getCustomerFactory() : CustomerInterfaceFactory
        {
            return $this->_customerFactory;
        }
    }
?>