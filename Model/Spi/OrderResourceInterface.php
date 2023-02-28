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
            FIELD_CODE = 'code',
            FIELD_STATE = 'state',
            FIELD_CUSTOMER_ID = 'customer_id',
            FIELD_INVOICE = 'invoice',
            FIELD_INVOICE_DETAILS_ID = 'invoice_details_id',
            FIELD_COMMENTS = 'comments',
            FIELD_COURIER = 'courier',
            FIELD_COURIER_VOUCHER = 'courier_voucher',
            FIELD_COURIER_TRACKING_CODES = 'courier_tracking_codes',
            FIELD_LINE_ITEMS = 'line_items',
            FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id',
            FIELD_REJECT_OPTIONS_ID = 'reject_options_id',
            FIELD_CREATED_AT = 'created_at',
            FIELD_EXPIRES_AT = 'expires_at',
            FIELD_DISPATCH_UNTIL = 'dispatch_until',
            FIELD_MAGENTO_ORDER_ID = 'magento_order_id',
            FIELD_EXPRESS = 'express',
            FIELD_CUSTOM = 'custom',
            FIELD_GIFT_WRAP = 'gift_wrap',
            FIELD_FULFILLED_BY_SKROUTZ = 'fulfilled_by_skroutz',
            FIELD_FBS_DELIVERY_NOTE = 'fbs_delivery_note',
            FIELD_STORE_PICKUP = 'store_pickup',
            FIELD_REJECTION_INFO_ID = 'rejection_info_id',
            FIELD_PICKUP_WINDOW_ID = 'pickup_window_id',
            FIELD_PICKUP_ADDRESS = 'pickup_address',
            FIELD_NUMBER_OF_PARCELS = 'number_of_parcels';

        /**
         * Saves Order data
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
         * Loads an Order by Id
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
         * Loads an Order by Code
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         * @param string $code
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderResourceInterface
         */
        function loadOrderByCode(OrderInterface $order, string $code): OrderResourceInterface;

        /**
         * Loads an Order by Magento Order Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         * @param mixed $magentoOrderId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderResourceInterface
         */
        function loadOrderByMagentoOrderId(OrderInterface $order, $magentoOrderId): OrderResourceInterface;

        /**
         * Deletes the Order
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