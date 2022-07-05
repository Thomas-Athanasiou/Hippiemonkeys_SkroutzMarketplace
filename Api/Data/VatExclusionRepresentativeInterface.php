<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface VatExclusionRepresentativeInterface
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
         * Gets ID Type
         *
         * @return string
         */
        function getIdType(): string;

        /**
         * Sets ID Type
         *
         * @param string $idType
         * @return $this
         */
        function setIdType(string $idType);

        /**
         * Get ID Number
         *
         * @return string
         */
        function getIdNumber(): string;

        /**
         * Set ID Number
         *
         * @param string $idNumber
         * @return $this
         */
        function setIdNumber(string $idNumber);

        /**
         * Gets Otp
         *
         * @return string
         */
        function getOtp(): string;

        /**
         * Sets Otp
         *
         * @param string $otp
         * @return $this
         */
        function setOtp(string $otp);
    }
?>