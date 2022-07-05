<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectionInfoInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\RejectionInfo as ResourceModel;

    class RejectionInfo
    extends AbstractModel
    implements RejectionInfoInterface
    {
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getReason(): string
        {
            return $this->getData(ResourceModel::FIELD_REASON);
        }

        /**
         * @inheritdoc
         */
        public function setReason(string $reason)
        {
            return $this->setData(ResourceModel::FIELD_REASON, $reason);
        }

        /**
         * @inheritdoc
         */
        public function getActor(): string
        {
            return $this->getData(ResourceModel::FIELD_ACTOR);
        }

        /**
         * @inheritdoc
         */
        public function setActor(string $actor)
        {
            return $this->setData(ResourceModel::FIELD_ACTOR, $actor);
        }
    }
?>