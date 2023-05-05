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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Pickup Window Relation Resource interface
     */
    interface AcceptOptionsPickupWindowRelationResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id',
            FIELD_PICKUP_WINDOW_ID  = 'pickup_window_id';

        /**
         * Save Accept Options Pickup Window Relation to the resource storage
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationResourceInterface
         */
        function saveAcceptOptionsPickupWindowRelation(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation): AcceptOptionsPickupWindowRelationResourceInterface;

        /**
         * Load a Accept Options Pickup Window Relation by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationResourceInterface
         */
        function loadAcceptOptionsPickupWindowRelationById(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation, $id): AcceptOptionsPickupWindowRelationResourceInterface;

        /**
         * Delete the AcceptOptionsPickupWindowRelation
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation
         *
         * @return bool
         */
        function deleteAcceptOptionsPickupWindowRelation(AcceptOptionsPickupWindowRelationInterface $AcceptOptionsPickupWindowRelation): bool;
    }
?>