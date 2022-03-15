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

    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Address as ResourceModel;

    class Address
    extends AbstractModel
    implements AddressInterface
    {
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getStreetName() : string
        {
            return $this->getData(ResourceModel::FIELD_STREET_NAME);
        }
        /**
         * @inheritdoc
         */
        public function setStreetName(string $streetName)
        {
            return $this->setData(ResourceModel::FIELD_STREET_NAME, $streetName);
        }

        /**
         * @inheritdoc
         */
        public function getStreetNumber() : string
        {
            return $this->getData(ResourceModel::FIELD_STREET_NUMBER);
        }
        /**
         * @inheritdoc
         */
        public function setStreetNumber(string $streetNumber)
        {
            return $this->setData(ResourceModel::FIELD_STREET_NUMBER, $streetNumber);
        }

        /**
         * @inheritdoc
         */
        public function getZip() : string
        {
            return $this->getData(ResourceModel::FIELD_ZIP);
        }
        /**
         * @inheritdoc
         */
        public function setZip(string $zip)
        {
            return $this->setData(ResourceModel::FIELD_ZIP, $zip);
        }

        /**
         * @inheritdoc
         */
        function getCity() : string
        {
            return $this->getData(ResourceModel::FIELD_CITY);
        }
        /**
         * @inheritdoc
         */
        function setCity(string $city)
        {
            return $this->setData(ResourceModel::FIELD_CITY, $city);
        }

        /**
         * @inheritdoc
         */
        public function getRegion() : string
        {
            return $this->getData(ResourceModel::FIELD_REGION);
        }
        /**
         * @inheritdoc
         */
        public function setRegion(string $region)
        {
            return $this->setData(ResourceModel::FIELD_REGION, $region);
        }

        /**
         * @inheritdoc
         */
        public function getPickupFromCollectionPoint()
        {
            return $this->getData(ResourceModel::FIELD_PICKUP_FROM_COLLECTION_POINT);
        }
        /**
         * @inheritdoc
         */
        public function setPickupFromCollectionPoint($pickupFromCollectionPoint)
        {
            return $this->setData(ResourceModel::FIELD_PICKUP_FROM_COLLECTION_POINT, $pickupFromCollectionPoint);
        }

        /**
         * @inheritdoc
         */
        public function getCollectionPointAddress() : string
        {
            return $this->getData(ResourceModel::FIELD_COLLECTION_POINT_ADDRESS);
        }
        /**
         * @inheritdoc
         */
        public function setCollectionPointAddress(string $collectionPointAddress)
        {
            return $this->setData(ResourceModel::FIELD_COLLECTION_POINT_ADDRESS, $collectionPointAddress);
        }
    }
?>