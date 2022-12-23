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

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AddressResourceInterface as ResourceInterface;

    class Address
    extends AbstractModel
    implements AddressInterface
    {
        /**
         * {@inheritdoc}
         */
        public function getStreetName() : string
        {
            return $this->getData(ResourceInterface::FIELD_STREET_NAME);
        }

        /**
         * {@inheritdoc}
         */
        public function setStreetName(string $streetName): Address
        {
            return $this->setData(ResourceInterface::FIELD_STREET_NAME, $streetName);
        }

        /**
         * {@inheritdoc}
         */
        public function getStreetNumber() : string
        {
            return $this->getData(ResourceInterface::FIELD_STREET_NUMBER);
        }

        /**
         * {@inheritdoc}
         */
        public function setStreetNumber(string $streetNumber): Address
        {
            return $this->setData(ResourceInterface::FIELD_STREET_NUMBER, $streetNumber);
        }

        /**
         * {@inheritdoc}
         */
        public function getZip() : string
        {
            return $this->getData(ResourceInterface::FIELD_ZIP);
        }

        /**
         * {@inheritdoc}
         */
        public function setZip(string $zip): Address
        {
            return $this->setData(ResourceInterface::FIELD_ZIP, $zip);
        }

        /**
         * {@inheritdoc}
         */
        function getCity() : string
        {
            return $this->getData(ResourceInterface::FIELD_CITY);
        }

        /**
         * {@inheritdoc}
         */
        function setCity(string $city): Address
        {
            return $this->setData(ResourceInterface::FIELD_CITY, $city);
        }

        /**
         * {@inheritdoc}
         */
        public function getRegion() : string
        {
            return $this->getData(ResourceInterface::FIELD_REGION);
        }

        /**
         * {@inheritdoc}
         */
        public function setRegion(string $region): Address
        {
            return $this->setData(ResourceInterface::FIELD_REGION, $region);
        }

        /**
         * {@inheritdoc}
         */
        public function getCountryCode() : string
        {
            return $this->getData(ResourceInterface::FIELD_COUNTRY_CODE);
        }

        /**
         * {@inheritdoc}
         */
        public function setCountryCode(string $countryCode): Address
        {
            return $this->setData(ResourceInterface::FIELD_COUNTRY_CODE, $countryCode);
        }

        /**
         * {@inheritdoc}
         */
        public function getPickupFromCollectionPoint(): ?bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_PICKUP_FROM_COLLECTION_POINT);
        }

        /**
         * {@inheritdoc}
         */
        public function setPickupFromCollectionPoint($pickupFromCollectionPoint): Address
        {
            return $this->setData(ResourceInterface::FIELD_PICKUP_FROM_COLLECTION_POINT, $pickupFromCollectionPoint);
        }

        /**
         * {@inheritdoc}
         */
        public function getCollectionPointAddress() : string
        {
            return $this->getData(ResourceInterface::FIELD_COLLECTION_POINT_ADDRESS);
        }

        /**
         * {@inheritdoc}
         */
        public function setCollectionPointAddress(string $collectionPointAddress): Address
        {
            return $this->setData(ResourceInterface::FIELD_COLLECTION_POINT_ADDRESS, $collectionPointAddress);
        }
    }
?>