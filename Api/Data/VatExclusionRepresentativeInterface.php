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
    interface VatExclusionRepresentativeInterface
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
         * Gets ID Type
         *
         * @access public
         *
         * @return string
         */
        function getIdType(): string;

        /**
         * Sets ID Type
         *
         * @access public
         *
         * @param string $idType
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface
         */
        function setIdType(string $idType): VatExclusionRepresentativeInterface;

        /**
         * Get ID Number
         *
         * @access public
         *
         * @return string
         */
        function getIdNumber(): string;

        /**
         * Set ID Number
         *
         * @access public
         *
         * @param string $idNumber
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface
         */
        function setIdNumber(string $idNumber): VatExclusionRepresentativeInterface;

        /**
         * Gets Otp
         *
         * @access public
         *
         * @return string
         */
        function getOtp(): string;

        /**
         * Sets Otp
         *
         * @access public
         *
         * @param string $otp
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface
         */
        function setOtp(string $otp): VatExclusionRepresentativeInterface;
    }
?>