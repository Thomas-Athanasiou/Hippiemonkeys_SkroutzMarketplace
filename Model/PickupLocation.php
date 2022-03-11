<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,

        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\PickupLocation as ResourceModel;

    class PickupLocation
    extends AbstractModel
    implements PickupLocationInterface
    {
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getLocalId()
        {
            return (int) $this->getData(ResourceModel::FIELD_LOCAL_ID);
        }
        /**
         * @inheritdoc
         */
        public function setLocalId(int $localId)
        {
            return $this->setData(ResourceModel::FIELD_LOCAL_ID, (string) $localId);
        }

        /**
         * @inheritdoc
         */
        public function getSkroutzId(): string
        {
            return $this->getData(ResourceModel::FIELD_SKROUTZ_ID);
        }
        /**
         * @inheritdoc
         */
        public function setSkroutzId(string $skroutzId)
        {
            return $this->setData(ResourceModel::FIELD_SKROUTZ_ID, $skroutzId);
        }

        /**
         * @inheritdoc
         */
        public function getLabel(): string
        {
            return $this->getData(ResourceModel::FIELD_LABEL);
        }
        /**
         * @inheritdoc
         */
        public function setLabel(string $label)
        {
            return $this->setData(ResourceModel::FIELD_LABEL, $label);
        }
    }
?>