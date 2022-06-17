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

        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderPickupWindowInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\OrderPickupWindow as ResourceModel;

    class OrderPickupWindow
    extends AbstractModel
    implements OrderPickupWindowInterface
    {
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getId()
        {
            return $this->getData(ResourceModel::FIELD_ID);
        }

        /**
         * @inheritdoc
         */
        public function setId($id)
        {
            return $this->setData(ResourceModel::FIELD_LOCAL_ID, (string) $localId);
        }

        /**
         * @inheritdoc
         */
        public function getFrom(): string
        {
            return $this->getData(ResourceModel::FIELD_FROM);
        }

        /**
         * @inheritdoc
         */
        public function setFrom(string $from)
        {
            return $this->setData(ResourceModel::FIELD_FROM, $from);
        }

        /**
         * @inheritdoc
         */
        public function getTo(): string
        {
            return $this->getData(ResourceModel::FIELD_TO);
        }

        /**
         * @inheritdoc
         */
        public function setTo(string $to)
        {
            return $this->setData(ResourceModel::FIELD_TO, $to);
        }
    }
?>