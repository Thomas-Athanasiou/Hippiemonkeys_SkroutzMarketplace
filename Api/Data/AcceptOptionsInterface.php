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

    namespace Hippiemonkeys\SkroutzMarketplace\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    /**
     * @api
     */
    interface AcceptOptionsInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @access public
         *
         * @param mixed $value
         *
         * @return mixed
         */
        function setId($id);

        /**
         * Get number of parcels
         *
         * @access public
         *
         * @return int[]
         */
        function getNumberOfParcels() : array;

        /**
         * Set number of parcels
         *
         * @access public
         *
         * @param int[] $numberOfParcels
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface
         */
        function setNumberOfParcels(array $numberOfParcels): AcceptOptionsInterface;

        /**
         * Get pickup locations
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface[]
         */
        function getPickupLocation(): array;

        /**
         * Set pickup locations
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface[] $pickupLocation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface
         */
        function setPickupLocation(array $pickupLocation): AcceptOptionsInterface;

        /**
         * Get pickup windows
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface[]
         */
        function getPickupWindow(): array;

        /**
         * Set pickup windows
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface[] $pickupLocation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface
         */
        function setPickupWindow(array $pickupWindow): AcceptOptionsInterface;

        /**
         * Get Order
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function getOrder(): OrderInterface;

        /**
         * Set Order
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface
         */
        function setOrder(OrderInterface $order): AcceptOptionsInterface;
    }
?>