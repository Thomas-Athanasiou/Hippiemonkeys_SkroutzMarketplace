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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface;

    interface OrderManagementInterface
    {
        /**
         * Process order
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return void
         */
        function processOrder(OrderInterface $order): void;

        /**
         * Update and Process order
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return void
         */
        function updateAndProcessOrder(OrderInterface $order): void;

        /**
         * Updates and Processes orders with given state
         *
         * @api
         * @access public
         *
         * @param string $state
         *
         * @return void
         */
        function updateAndProcessOrdersWithState(string $state): void;

        /**
         * Updates and Processes orders with given state and limit
         *
         * @api
         * @access public
         *
         * @param string $state
         * @param int $limit
         *
         * @return void
         */
        function updateAndProcessOrdersWithStateAndLimit(string $state, int $limit): void;
    }
?>