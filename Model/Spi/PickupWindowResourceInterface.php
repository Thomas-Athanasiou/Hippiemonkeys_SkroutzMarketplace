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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface PickupWindowResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_ORDER_ID = 'order_id',
            FIELD_NUMBER_OF_PARCELS = 'number_of_parcels',
            FIELD_PICKUP_LOCATION = 'pickup_location',
            FIELD_PICKUP_WINDOW = 'pickup_window';

        /**
         * Save PickupWindow data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface $pickupWindow
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowResourceInterface
         */
        function savePickupWindow(PickupWindowInterface $pickupWindow): PickupWindowResourceInterface;

        /**
         * Load a PickupWindow by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface $pickupWindow
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowResourceInterface
         */
        function loadPickupWindowById(PickupWindowInterface $pickupWindow, $id): PickupWindowResourceInterface;

        /**
         * Delete the PickupWindow
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface $pickupWindow
         *
         * @return bool
         */
        function deletePickupWindow(PickupWindowInterface $pickupWindow): bool;
    }
?>