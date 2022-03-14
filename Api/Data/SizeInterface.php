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

    interface SizeInterface
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
         * @param mixed $value
         * @return $this
         */
        function setId($id);

        /**
         * Gets Label
         *
         * @return string.
         */
        function getLabel();
        /**
         * Sets Label
         *
         * @param string $label
         * @return $this
         */
        function setLabel($label);

        /**
         * Gets Value
         *
         * @return string.
         */
        function getValue();
        /**
         * Sets Value
         *
         * @param string $value
         * @return $this
         */
        function setValue($value);

        /**
         * Gets shop value
         *
         * @return string.
         */
        function getShopValue();
        /**
         * Sets shop value
         *
         * @param string|null $shop_value
         * @return $this
         */
        function setShopValue($shopValue);
    }
?>