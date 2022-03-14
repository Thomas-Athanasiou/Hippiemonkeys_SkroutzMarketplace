<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\VatExclusionRepresentative as ResourceModel,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\VatExclusionRepresentativeInterface;

    class VatExclusionRepresentative
    extends AbstractModel
    implements VatExclusionRepresentativeInterface
    {
        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getIdType(): string
        {
            return $this->getData(ResourceModel::FIELD_ID_TYPE);
        }
        /**
         * @inheritdoc
         */
        public function setIdType(string $idType)
        {
            return $this->setData(ResourceModel::FIELD_ID_TYPE, $idType);
        }

        /**
         * @inheritdoc
         */
        function getIdNumber(): string
        {
            return $this->getData(ResourceModel::FIELD_ID_NUMBER);
        }
        /**
         * @inheritdoc
         */
        public function setIdNumber(string $idNumber)
        {
            return $this->setData(ResourceModel::FIELD_ID_NUMBER, $idNumber);
        }

        /**
         * @inheritdoc
         */
        public function getOtp(): string
        {
            return $this->getData(ResourceModel::FIELD_OTP);
        }
        /**
         * @inheritdoc
         */
        public function setOtp(string $otp)
        {
            return $this->setData(ResourceModel::FIELD_OTP, $otp);
        }
    }
?>