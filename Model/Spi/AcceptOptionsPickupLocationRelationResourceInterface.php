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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Pickup Location Relation Resource interface
     */
    interface AcceptOptionsPickupLocationRelationResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id',
            FIELD_PICKUP_LOCATION_ID = 'pickup_location_id';

        /**
         * Save Accept Options Pickup Location Relation to the resource storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationResourceInterface
         */
        function saveAcceptOptionsPickupLocationRelation(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation): AcceptOptionsPickupLocationRelationResourceInterface;

        /**
         * Loads a Accept Options Pickup Location Relation by Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationResourceInterface
         */
        function loadAcceptOptionsPickupLocationRelationById(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation, $id): AcceptOptionsPickupLocationRelationResourceInterface;

        /**
         * Deletes the Accept Options Pickup Location Relation from the resource storage
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation
         *
         * @return bool
         */
        function deleteAcceptOptionsPickupLocationRelation(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation): bool;
    }
?>