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

        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\LineItemRejectionReason as ResourceModel;

    class LineItemRejectionReason
    extends AbstractModel
    implements LineItemRejectionReasonInterface
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

        /**
         * @inheritdoc
         */
        public function getRequiresAvailableQuantity(): bool
        {
            return (bool) $this->getData(ResourceModel::FIELD_REQUIRES_AVAILABILITY_QUANTITY);
        }
        /**
         * @inheritdoc
         */
        public function setRequiresAvailableQuantity(bool $requiresAvailableQuantity)
        {
            return $this->setData(ResourceModel::FIELD_REQUIRES_AVAILABILITY_QUANTITY, $requiresAvailableQuantity);
        }
    }
?>