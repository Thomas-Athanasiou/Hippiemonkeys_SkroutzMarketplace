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

    interface CustomerManagementInterface
    {
        /**
         * Saves a Customer and its dependencies
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface $customer
         *
         * @return void
         */
        function saveCustomer(CustomerInterface $customer): void;

        /**
         * Synchronizes Customer with the persistent storage data
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface $customer
         *
         * @return void
         */
        function syncCustomer(CustomerInterface $customer): void;
    }
?>