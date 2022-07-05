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

    interface InvoiceDetailsInterface
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
         * Gets Company
         *
         * @return string.
         */
        function getCompany(): string;
        /**
         * Sets Company
         *
         * @param mixed $company
         * @return $this
         */
        function setCompany(string $company);

        /**
         * Gets Profession
         *
         * @return string.
         */
        function getProfession(): string;
        /**
         * Sets Company
         *
         * @param mixed $profession
         * @return $this
         */
        function setProfession(string $profession);

        /**
         * Gets Vat Number
         *
         * @return string.
         */
        function getVatNumber(): string;
        /**
         * Sets Vat Number
         *
         * @param mixed $vatNumber
         * @return $this
         */
        function setVatNumber(string $vatNumber);

        /**
         * Gets Company's public economic service
         *
         * @return string.
         */
        function getDoy(): string;
        /**
         * Sets Company's public economic service
         *
         * @param mixed $doy
         * @return $this
         */
        function setDoy(string $doy);

        /**
         * Gets Address
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface|null
         */
        function getAddress();
        /**
         * Sets Address
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface|null $address
         * @return $this
         */
        function setAddress($address);

        /**
         * Gets Vat Exclusion Requested
         *
         * @return bool.
         */
        function getVatExclusionRequested(): bool;
        /**
         * Sets Address
         *
         * @param mixed $doy
         * @return $this
         */
        function setVatExclusionRequested(bool $vatExclusionRequested);

        /**
         * Gets Vat Exclusion Representative
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\VatExclusionRepresentativeInterface.
         */
        function getVatExclusionRepresentative(): VatExclusionRepresentativeInterface;
        /**
         * Sets Vat Exclusion Representative
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\VatExclusionRepresentativeInterface $vatExclusionRepresentative
         * @return $this
         */
        function setVatExclusionRepresentative(VatExclusionRepresentativeInterface $vatExclusionRepresentative);
    }
?>