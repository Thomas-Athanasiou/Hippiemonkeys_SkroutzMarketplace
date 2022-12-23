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

    use Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupLocationResourceInterface as ResourceInterface;

    class PickupLocation
    extends AbstractModel
    implements PickupLocationInterface
    {
        /**
         * @inheritdoc
         */
        public function getSkroutzId(): string
        {
            return $this->getData(ResourceInterface::FIELD_SKROUTZ_ID);
        }

        /**
         * @inheritdoc
         */
        public function setSkroutzId(string $skroutzId): PickupLocation
        {
            return $this->setData(ResourceInterface::FIELD_SKROUTZ_ID, $skroutzId);
        }

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
        public function setLabel(string $label): PickupLocation
        {
            return $this->setData(ResourceInterface::FIELD_LABEL, $label);
        }
    }
?>