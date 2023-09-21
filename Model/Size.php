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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\SizeResourceInterface as ResourceInterface;

    class Size
    extends AbstractModel
    implements SizeInterface
    {
        /**
         * @inheritdoc
         */
        public function getLabel(): string
        {
            return $this->getData(ResourceInterface::FIELD_LABEL);
        }

        /**
         * @inheritdoc
         */
        public function setLabel(string $label): Size
        {
            return $this->setData(ResourceInterface::FIELD_LABEL, $label);
        }

        /**
         * @inheritdoc
         */
        public function getValue(): string
        {
            return $this->getData(ResourceInterface::FIELD_VALUE);
        }

        /**
         * @inheritdoc
         */
        public function setValue(string $value): Size
        {
            return $this->setData(ResourceInterface::FIELD_VALUE, $value);
        }

        /**
         * @inheritdoc
         */
        public function getShopValue(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_SHOP_VALUE);
        }

        /**
         * @inheritdoc
         */
        public function setShopValue(?string $shopValue): Size
        {
            return $this->setData(ResourceInterface::FIELD_SHOP_VALUE, $shopValue);
        }

        /**
         * @inheritdoc
         */
        public function getShopVariationUid(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_SHOP_VARIATION_UID);
        }

        /**
         * @inheritdoc
         */
        public function setShopVariationUid(?string $shopVariationUid): Size
        {
            return $this->setData(ResourceInterface::FIELD_SHOP_VARIATION_UID, $shopVariationUid);
        }

        /**
         * @inheritdoc
         */
        public function getEan(): ?string
        {
            return $this->getData(ResourceInterface::FIELD_EAN);
        }

        /**
         * @inheritdoc
         */
        public function setEan(?string $ean): SizeInterface
        {
            return $this->setData(ResourceInterface::FIELD_EAN, $ean);
        }
    }
?>