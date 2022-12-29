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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface OrderPickupWindowResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_FROM = 'from',
            FIELD_TO = 'to';

        /**
         * Save Order Pickup Window data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface $orderPickupWindow
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowResourceInterface
         */
        function saveOrderPickupWindow(OrderPickupWindowInterface $orderPickupWindow): OrderPickupWindowResourceInterface;

        /**
         * Load a OrderPickupWindow by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface $orderPickupWindow
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowResourceInterface
         */
        function loadOrderPickupWindowById(OrderPickupWindowInterface $orderPickupWindow, $id): OrderPickupWindowResourceInterface;

        /**
         * Delete the OrderPickupWindow
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface $orderPickupWindow
         *
         * @return bool
         */
        function deleteOrderPickupWindow(OrderPickupWindowInterface $orderPickupWindow): bool;
    }
?>