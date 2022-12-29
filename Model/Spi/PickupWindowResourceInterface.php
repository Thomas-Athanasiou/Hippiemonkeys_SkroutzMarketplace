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
     * Pickup Window Resource interface
     */
    interface PickupWindowResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_SKROUTZ_ID = 'id',
            FIELD_LABEL = 'label';

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
         * Load a Pickup Window by Skroutz Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface $pickupWindow
         * @param int $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowResourceInterface
         */
        function loadPickupWindowBySkroutzId(PickupWindowInterface $pickupWindow, int $skroutzId): PickupWindowResourceInterface;

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