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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderPickupWindowResourceInterface as ResourceInterface;

    class OrderPickupWindow
    extends AbstractModel
    implements OrderPickupWindowInterface
    {
        /**
         * @inheritdoc
         */
        public function setId($id)
        {
            return $this->setData(ResourceInterface::FIELD_ID, $id);
        }

        /**
         * @inheritdoc
         */
        public function getFrom(): string
        {
            return $this->getData(ResourceInterface::FIELD_FROM);
        }

        /**
         * @inheritdoc
         */
        public function setFrom(string $from): OrderPickupWindow
        {
            return $this->setData(ResourceInterface::FIELD_FROM, $from);
        }

        /**
         * @inheritdoc
         */
        public function getTo(): string
        {
            return $this->getData(ResourceInterface::FIELD_TO);
        }

        /**
         * @inheritdoc
         */
        public function setTo(string $to): OrderPickupWindow
        {
            return $this->setData(ResourceInterface::FIELD_TO, $to);
        }
    }
?>