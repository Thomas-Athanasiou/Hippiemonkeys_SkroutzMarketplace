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
         * @return $this
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
         * @return $this
         */
        function setCompany(string $company);

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
         * @return $this
         */
        function setProfession(string $profession);

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
         * @return $this
         */
        function setVatNumber(string $vatNumber);

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
         * @return $this
         */
        function setDoy(string $doy);

        /**
         * Gets Address
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface|null
         */
        function getAddress();
        /**
         * Sets Address
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface|null $address
         *
         * @return $this
         */
        function setAddress($address);

        /**
         * Gets Vat Exclusion Requested
         *
         * @api
         * @access public
         *
         * @return bool.
         */
        function getVatExclusionRequested(): bool;
        /**
         * Sets Address
         *
         * @api
         * @access public
         *
         * @param mixed $doy
         *
         * @return $this
         */
        function setVatExclusionRequested(bool $vatExclusionRequested);

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
         * @return $this
         */
        function setVatExclusionRepresentative(VatExclusionRepresentativeInterface $vatExclusionRepresentative);
    }
?>