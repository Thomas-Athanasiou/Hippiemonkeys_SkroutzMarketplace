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

    interface InvoiceDetailsInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string.
         */
        function getCompany(): string;

        /**
         * Sets Company
         *
         * @api
         * @access public
         *
         * @param mixed $company
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setCompany(string $company): InvoiceDetailsInterface;

        /**
         * Gets Profession
         *
         * @api
         * @access public
         *
         * @return string.
         */
        function getProfession(): string;

        /**
         * Sets Company
         *
         * @api
         * @access public
         *
         * @param mixed $profession
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setProfession(string $profession): InvoiceDetailsInterface;

        /**
         * Gets Vat Number
         *
         * @api
         * @access public
         *
         * @return string.
         */
        function getVatNumber(): string;

        /**
         * Sets Vat Number
         *
         * @api
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
         * @api
         * @access public
         *
         * @return string.
         */
        function getDoy(): string;

        /**
         * Sets Company's public economic service
         *
         * @api
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
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface|null
         */
        function getAddress(): ?AddressInterface;

        /**
         * Sets Address
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface|null $address
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setAddress(?AddressInterface $address): InvoiceDetailsInterface;

        /**
         * Gets Vat Exclusion Requested
         *
         * @api
         * @access public
         *
         * @return bool
         */
        function getVatExclusionRequested(): bool;

        /**
         * Sets Vat Exclusion Requested
         *
         * @api
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
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface.
         */
        function getVatExclusionRepresentative(): VatExclusionRepresentativeInterface;

        /**
         * Sets Vat Exclusion Representative
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface $vatExclusionRepresentative
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface
         */
        function setVatExclusionRepresentative(VatExclusionRepresentativeInterface $vatExclusionRepresentative);
    }
?>