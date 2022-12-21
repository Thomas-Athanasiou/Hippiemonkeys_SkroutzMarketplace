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
        Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Customer as ResourceModel;

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