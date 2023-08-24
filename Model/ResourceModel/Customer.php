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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\CustomerResourceInterface;

    class Customer
    extends AbstractResource
    implements CustomerResourceInterface
    {
        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzmarketplace_customer';

        /**
         * {@inheritdoc}
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function saveCustomer(CustomerInterface $customer): self
        {
            return $this->saveModel($customer);
        }

        /**
         * {@inheritdoc}
         */
        public function loadCustomerById(CustomerInterface $customer, $id): self
        {
            return $this->loadModelById($customer, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function loadCustomerBySkroutzId(CustomerInterface $customer, string $skroutzId): self
        {
            return $this->loadModel($customer, $skroutzId, static::FIELD_SKROUTZ_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteCustomer(CustomerInterface $customer): bool
        {
            return $this->deleteModel($customer);
        }
    }
?>