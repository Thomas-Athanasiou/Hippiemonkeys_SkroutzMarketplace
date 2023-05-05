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

    interface RejectionInfoInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @param mixed $value
         *
         * @return mixed
         */
        function setId($id);

        /**
         * Gets Reason
         *
         * @api
         * @access public
         *
         * @return string.
         */
        function getReason(): string;

        /**
         * Sets Reason
         *
         * @api
         * @access public
         *
         * @param string $reason
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface
         */
        function setReason(string $reason);

        /**
         * Gets Actor
         *
         * @api
         * @access public
         *
         * @return string.
         */
        function getActor(): string;

        /**
         * Sets Actor
         *
         * @api
         * @access public
         *
         * @param string $actor
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface
         */
        function setActor(string $actor);
    }
?>