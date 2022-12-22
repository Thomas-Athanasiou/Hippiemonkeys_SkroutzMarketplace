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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface OrderResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_ORDER_ID = 'order_id',
            FIELD_NUMBER_OF_PARCELS = 'number_of_parcels',
            FIELD_PICKUP_LOCATION = 'pickup_location',
            FIELD_PICKUP_WINDOW = 'pickup_window';

        /**
         * Save Order data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderResourceInterface
         */
        function saveOrder(OrderInterface $order): OrderResourceInterface;

        /**
         * Load a Order by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderResourceInterface
         */
        function loadOrderById(OrderInterface $order, $id): OrderResourceInterface;

        /**
         * Delete the Order
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return bool
         */
        function deleteOrder(OrderInterface $order): bool;
    }
?>