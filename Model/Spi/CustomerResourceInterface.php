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

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Customer Resource interface
     */
    interface CustomerResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_SKROUTZ_ID = 'skroutz_id',
            FIELD_FIRST_NAME = 'first_name',
            FIELD_LAST_NAME = 'last_name',
            FIELD_ADDRESS_ID = 'address_id';

        /**
         * Saves Customer data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface $customer
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerResourceInterface
         */
        function saveCustomer(CustomerInterface $customer): CustomerResourceInterface;

        /**
         * Loads a Customer by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface $customer
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerResourceInterface
         */
        function loadCustomerById(CustomerInterface $customer, $id): CustomerResourceInterface;

        /**
         * Loads a Customer by Skroutz Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface $customer
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerResourceInterface
         */
        function loadCustomerBySkroutzId(CustomerInterface $customer, string $skroutzId): CustomerResourceInterface;

        /**
         * Deletes the Customer
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface $customer
         *
         * @return bool
         */
        function deleteCustomer(CustomerInterface $customer): bool;
    }
?>