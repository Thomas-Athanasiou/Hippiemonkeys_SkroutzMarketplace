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

    interface OrderPickupWindowInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface
         */
        function setId($id);

        /**
         * Gets From
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getFrom(): string;

        /**
         * Sets From
         *
         * @api
         * @access public
         *
         * @param string $from
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface
         */
        function setFrom(string $from): OrderPickupWindowInterface;

        /**
         * Gets To
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getTo(): string;

        /**
         * Sets To
         *
         * @api
         * @access public
         *
         * @param string $to
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface
         */
        function setTo(string $to): OrderPickupWindowInterface;
    }
?>