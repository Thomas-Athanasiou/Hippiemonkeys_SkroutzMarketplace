<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface VatExclusionRepresentativeResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_ID = 'id',
            FIELD_ID_TYPE = 'id_type',
            FIELD_ID_NUMBER = 'id_number',
            FIELD_OTP = 'otp'
;

        /**
         * Saves Vat Exclusion Representative data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface $vatExclusionRepresentative
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeResourceInterface
         */
        function saveVatExclusionRepresentative(VatExclusionRepresentativeInterface $vatExclusionRepresentative): VatExclusionRepresentativeResourceInterface;

        /**
         * Loads a Vat Exclusion Representative by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface $vatExclusionRepresentative
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeResourceInterface
         */
        function loadVatExclusionRepresentativeById(VatExclusionRepresentativeInterface $vatExclusionRepresentative, $id): VatExclusionRepresentativeResourceInterface;

        /**
         * Deletes the Vat Exclusion Representative
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface $vatExclusionRepresentative
         *
         * @return bool
         */
        function deleteVatExclusionRepresentative(VatExclusionRepresentativeInterface $VatExclusionRepresentative): bool;
    }
?>