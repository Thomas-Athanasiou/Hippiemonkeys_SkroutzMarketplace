<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\RejectionInfo as ResourceModel;

    class RejectionInfo
    extends AbstractModel
    implements RejectionInfoInterface
    {
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
        public function setReason(string $reason): RejectionInfo
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
        public function setActor(string $actor): RejectionInfo
        {
            return $this->setData(ResourceModel::FIELD_ACTOR, $actor);
        }
    }
?>