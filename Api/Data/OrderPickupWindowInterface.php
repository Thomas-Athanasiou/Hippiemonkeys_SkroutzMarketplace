<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface OrderPickupWindowInterface
    {
        /**
         * Gets ID
         *
         * @return mixed.
         */
        function getId();

        /**
         * Sets ID
         *
         * @param mixed $id
         * @return \this
         */
        function setId($id);

        /**
         * Gets From
         *
         * @return string
         */
        function getFrom(): string;

        /**
         * Sets From
         *
         * @param string $from
         * @return \this
         */
        function setFrom(string $from);

        /**
         * Gets To
         *
         * @return string
         */
        function getTo(): string;

        /**
         * Sets To
         *
         * @param string $to
         * @return \this
         */
        function setTo(string $to);
    }
?>