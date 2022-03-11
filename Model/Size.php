<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Size as ResourceModel,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\SizeInterface;

    class Size
    extends AbstractModel
    implements SizeInterface
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
        public function getLabel()
        {
            return $this->getData(ResourceModel::FIELD_LABEL);
        }
        /**
         * @inheritdoc
         */
        public function setLabel($label)
        {
            return $this->setData(ResourceModel::FIELD_LABEL, $label);
        }

        /**
         * @inheritdoc
         */
        public function getValue()
        {
            return $this->getData(ResourceModel::FIELD_VALUE);
        }
        /**
         * @inheritdoc
         */
        public function setValue($value)
        {
            return $this->setData(ResourceModel::FIELD_VALUE, $value);
        }

        /**
         * @inheritdoc
         */
        public function getShopValue()
        {
            return $this->getData(ResourceModel::FIELD_SHOP_VALUE);
        }
        /**
         * @inheritdoc
         */
        public function setShopValue($shopValue)
        {
            return $this->setData(ResourceModel::FIELD_SHOP_VALUE, $shopValue);
        }
    }
?>