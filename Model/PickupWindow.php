<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,

        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\PickupWindow as ResourceModel;

    class PickupWindow
    extends AbstractModel
    implements PickupWindowInterface
    {
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getLocalId(): int
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
        public function getSkroutzId(): int
        {
            return (int) $this->getData(ResourceModel::FIELD_SKROUTZ_ID);
        }
        /**
         * @inheritdoc
         */
        public function setSkroutzId(int $skroutzId)
        {
            return $this->setData(ResourceModel::FIELD_SKROUTZ_ID, (string) $skroutzId);
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