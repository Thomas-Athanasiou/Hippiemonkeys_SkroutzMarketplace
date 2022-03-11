<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface PickupLocationInterface
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
         * Gets Local ID
         *
         * @return int|null.
         */
        function getLocalId();

        /**
         * Sets Local ID
         *
         * @param int $localId
         * @return $this
         */
        function setLocalId(int $localId);

        /**
         * Gets Skroutz ID
         *
         * @return string.
         */
        function getSkroutzId(): string;
        
        /**
         * Sets Skroutz ID
         *
         * @param string $value
         * @return $this
         */
        function setSkroutzId(string $skroutzId);

        /**
         * Get Label
         *
         * @return string
         */
        function getLabel(): string;

        /**
         * Get label
         *
         * @param string $label
         * @return $this
         */
        function setLabel(string $label);
    }
?>