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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface;

    interface OrderPickupWindowRepositoryInterface
    {
        /**
         * Gets Order Pickup Window instance by ID
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface
         */
        function getById($id): OrderPickupWindowInterface;

        /**
         * Deletes the Order Pickup Window instance from the repository
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface $orderPickupWindow
         *
         * @return bool
         */
        function delete(OrderPickupWindowInterface $orderPickupWindow): bool;

        /**
         * Saves the Order Pickup Window instance to the repository
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface $orderPickupWindow
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface
         */
        function save(OrderPickupWindowInterface $orderPickupWindow): OrderPickupWindowInterface;
    }
?>