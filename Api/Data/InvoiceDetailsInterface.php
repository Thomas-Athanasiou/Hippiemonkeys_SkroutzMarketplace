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
    interface InvoiceDetailsInterface
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
         * Gets Company
         *
         * @access public
         *
         * @return string.
         */
        function getCompany(): string;

        /**
         * Sets Company
         *
         * @access public
         *
         * @param mixed $company
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setCompany(string $company): InvoiceDetailsInterface;

        /**
         * Gets Profession
         *
         * @access public
         *
         * @return string.
         */
        function getProfession(): string;

        /**
         * Sets Company
         *
         * @access public
         *
         * @param mixed $profession
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setProfession(string $profession): InvoiceDetailsInterface;

        /**
         * Gets Vat Number
         *
         * @access public
         *
         * @return string.
         */
        function getVatNumber(): string;

        /**
         * Sets Vat Number
         *
         * @access public
         *
         * @param mixed $vatNumber
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setVatNumber(string $vatNumber): InvoiceDetailsInterface;

        /**
         * Gets Company's public economic service
         *
         * @access public
         *
         * @return string
         */
        function getDoy(): string;

        /**
         * Sets Company's public economic service
         *
         * @access public
         *
         * @param mixed $doy
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setDoy(string $doy): InvoiceDetailsInterface;

        /**
         * Gets Address
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface
         */
        function getAddress(): AddressInterface;

        /**
         * Sets Address
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface $address
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setAddress(AddressInterface $address): InvoiceDetailsInterface;

        /**
         * Gets Vat Exclusion Requested
         *
         * @access public
         *
         * @return bool
         */
        function getVatExclusionRequested(): bool;

        /**
         * Sets Vat Exclusion Requested
         *
         * @access public
         *
         * @param bool $vatExclusionRequested
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setVatExclusionRequested(bool $vatExclusionRequested): InvoiceDetailsInterface;

        /**
         * Gets Vat Exclusion Representative
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface
         */
        function getVatExclusionRepresentative(): VatExclusionRepresentativeInterface;

        /**
         * Sets Vat Exclusion Representative
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface $vatExclusionRepresentative
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setVatExclusionRepresentative(VatExclusionRepresentativeInterface $vatExclusionRepresentative): InvoiceDetailsInterface;
    }
?>