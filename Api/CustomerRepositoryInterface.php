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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface;

    interface CustomerRepositoryInterface
    {
        /**
         * Get Customer by local id
         *
         * @api
         * @access public
         *
         * @param int $localId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface
         */
        function getByLocalId(int $localId): CustomerInterface;

        /**
         * Get Customer skroutz id
         *
         * @api
         * @access public
         *
         * @param mixed $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface
         */
        function getBySkroutzId(string $skroutzId): CustomerInterface;

        /**
         * Delete Customer
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
         * Save Customer
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