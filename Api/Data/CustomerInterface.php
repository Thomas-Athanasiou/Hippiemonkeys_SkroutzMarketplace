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
    interface CustomerInterface
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
         * Gets Skroutz ID
         *
         * @access public
         *
         * @return string
         */
        function getSkroutzId(): string;

        /**
         * Sets Skroutz ID
         *
         * @access public
         *
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface
         */
        function setSkroutzId(string $skroutzId): CustomerInterface;

        /**
         * Gets the first name for the customer
         *
         * @access public
         *
         * @return string
         */
        function getFirstName(): string;

        /**
         * Sets the first name for the customer
         *
         * @access public
         *
         * @param string $firstname
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface
         */
        function setFirstName(string $firstName): CustomerInterface;

        /**
         * Gets the last name for the customer
         *
         * @access public
         *
         * @return string
         */
        function getLastName(): string;

        /**
         * Sets the last name for the customer
         *
         * @access public
         *
         * @param string $lastName
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface
         */
        function setLastName(string $lastName): CustomerInterface;

        /**
         * Get Customer's Address
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface|null
         */
        function getAddress(): ?AddressInterface;

        /**
         * Set Customer's Address
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface|null $address
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface
         */
        function setAddress(?AddressInterface $address): CustomerInterface;
    }
?>