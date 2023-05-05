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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface;

    interface SkroutzMarketplaceInterface
    {
        /**
         * Accepts an order
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         * @param int $numberOfParcels
         * @param Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         * @param Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface $pickupWindow
         *
         * @return object
         */
        function acceptOrder(OrderInterface $order, int $numberOfParcels, PickupLocationInterface $pickupLocation, PickupWindowInterface $pickupWindow): object;

        /**
         * Gets Order by its code
         *
         * @api
         * @access public
         *
         * @param string $code
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface|null
         */
        function getOrder(string $code): ?OrderInterface;
    }
?>