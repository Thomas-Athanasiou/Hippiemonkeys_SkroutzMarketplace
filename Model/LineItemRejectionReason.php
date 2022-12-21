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
    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Model\AbstractModel,

        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\LineItemRejectionReason as ResourceModel;

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