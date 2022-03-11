<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface PickupWindowInterface
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
         * @return int.
         */
        function getSkroutzId(): int;

        /**
         * Sets Skroutz ID
         *
         * @param int $value
         * @return $this
         */
        function setSkroutzId(int $skroutzId);

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