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

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Model\AbstractModel,

        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\OrderPickupWindow as ResourceModel;

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