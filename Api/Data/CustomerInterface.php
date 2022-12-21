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

    interface CustomerInterface
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
         * @return $this
         */
        function setId($id);

        /**
         * Gets Local ID
         *
         * @api
         * @access public
         *
         * @return int|null.
         */
        function getLocalId();

        /**
         * Sets Local ID
         *
         * @api
         *
         * @param int $localId
         *
         * @return $this
         */
        function setLocalId(int $localId);

        /**
         * Gets Skroutz ID
         *
         * @api
         *
         * @return string.
         */
        function getSkroutzId(): string;

        /**
         * Sets Skroutz ID
         *
         * @api
         *
         * @param string $skroutzId
         *
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
         *
         * @return $this
         */
        function setFirstName(string $firstName);

        /**
         * Gets the last name for the customer
         *
         * @api
         *
         * @return string Last name.
         */
        function getLastName(): string;

        /**
         * Sets the last name for the customer
         *
         * @api
         *
         * @param string $lastname
         *
         * @return $this
         */
        function setLastName(string $lastName);

        /**
         * Get Customer's Address
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface|null
         */
        function getAddress();

        /**
         * Set Customer's Address
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface|null $address
         *
         * @return $this
         */
        function setAddress($address);
    }
?>