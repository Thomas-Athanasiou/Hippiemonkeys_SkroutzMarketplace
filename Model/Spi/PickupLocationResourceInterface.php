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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Pickup Location Resource interface
     */
    interface PickupLocationResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_SKROUTZ_ID = 'skroutz_id',
            FIELD_LABEL = 'label';

        /**
         * Saves Pickup Location data
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationResourceInterface
         */
        function savePickupLocation(PickupLocationInterface $pickupLocation): PickupLocationResourceInterface;

        /**
         * Loads a Pickup Location by Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationResourceInterface
         */
        function loadPickupLocationById(PickupLocationInterface $pickupLocation, $id): PickupLocationResourceInterface;

        /**
         * Loads a Pickup Location by Skroutz Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationResourceInterface
         */
        function loadPickupLocationBySkroutzId(PickupLocationInterface $pickupLocation, string $skroutzId): PickupLocationResourceInterface;

        /**
         * Deletes the Pickup Location
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return bool
         */
        function deletePickupLocation(PickupLocationInterface $PickupLocation): bool;
    }
?>