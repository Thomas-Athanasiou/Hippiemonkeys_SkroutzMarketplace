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
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Size as ResourceModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface;

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

        /**
         * @inheritdoc
         */
        public function getShopVariationUid()
        {
            return $this->getData(ResourceModel::FIELD_SHOP_VARIATION_UID);
        }

        /**
         * @inheritdoc
         */
        public function setShopVariationUid($shopVariationUid)
        {
            return $this->setData(ResourceModel::FIELD_SHOP_VARIATION_UID, $shopVariationUid);
        }
    }
?>