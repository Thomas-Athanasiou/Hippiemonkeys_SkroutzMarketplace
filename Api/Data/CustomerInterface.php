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

    interface CustomerInterface
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
         * @param string $skroutzId
         * @return $this
         */
        function setSkroutzId(string $skroutzId);

        /**
         * Gets the first name for the customer.
         *
         * @return string First name.
         */
        function getFirstName(): string;

        /**
         * Sets the first name for the customer.
         *
         * @param string $firstname
         * @return $this
         */
        function setFirstName(string $firstName);

        /**
         * Gets the last name for the customer.
         *
         * @return string Last name.
         */
        function getLastName(): string;

        /**
         * Sets the last name for the customer
         *
         * @param string $lastname
         * @return $this
         */
        function setLastName(string $lastName);

        /**
         * Get Customer's Address
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface|null
         */
        function getAddress();

        /**
         * Set Customer's Address
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface|null $address
         * @return $this
         */
        function setAddress($address);
    }
?>