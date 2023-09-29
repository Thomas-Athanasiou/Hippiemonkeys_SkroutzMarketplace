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
    interface AcceptOptionsPickupLocationRelationInterface
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
         * Gets Accept Options
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface
         */
        function getAcceptOptions(): AcceptOptionsInterface;

        /**
         * Sets Accept Options
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface $value
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface
         */
        function setAcceptOptions(AcceptOptionsInterface $acceptOptions): AcceptOptionsPickupLocationRelationInterface;

        /**
         * Gets Pickup Location
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface
         */
        function getPickupLocation(): PickupLocationInterface;

        /**
         * Sets Pickup Location
         *
         * @access public
         *
         * @param Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $value
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface
         */
        function setPickupLocation(PickupLocationInterface $pickupLocation): AcceptOptionsPickupLocationRelationInterface;
    }
?>