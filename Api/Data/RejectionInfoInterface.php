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

    interface RejectionInfoInterface
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
         * Gets Reason
         *
         * @return string.
         */
        function getReason(): string;

        /**
         * Sets Reason
         *
         * @param mixed $reason
         * @return $this
         */
        function setReason(string $reason);

        /**
         * Gets Actor
         *
         * @return string.
         */
        function getActor(): string;

        /**
         * Sets Actor
         *
         * @param mixed $actor
         * @return $this
         */
        function setActor(string $actor);
    }
?>