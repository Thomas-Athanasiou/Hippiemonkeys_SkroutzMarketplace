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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface;

    interface CustomerRepositoryInterface
    {
        /**
         * Gets Customer by Id
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface
         */
        function getById(int $id): CustomerInterface;

        /**
         * Gets Customer Skroutz Id
         *
         * @api
         * @access public
         *
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface
         */
        function getBySkroutzId(string $skroutzId): CustomerInterface;

        /**
         * Deletes Customer
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface $customer
         *
         * @return bool
         */
        function delete(CustomerInterface $customer): bool;

        /**
         * Saves Customer
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface $customer
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface
         */
        function save(CustomerInterface $customer): CustomerInterface;
    }
?>