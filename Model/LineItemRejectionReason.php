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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemRejectionReasonResourceInterface as ResourceInterface;

    class LineItemRejectionReason
    extends AbstractModel
    implements LineItemRejectionReasonInterface
    {
        /**
         * @inheritdoc
         */
        public function getSkroutzId(): int
        {
            return (int) $this->getData(ResourceInterface::FIELD_SKROUTZ_ID);
        }

        /**
         * @inheritdoc
         */
        public function setSkroutzId(int $skroutzId): self
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
        public function setLabel(string $label): self
        {
            return $this->setData(ResourceInterface::FIELD_LABEL, $label);
        }

        /**
         * @inheritdoc
         */
        public function getRequiresAvailableQuantity(): bool
        {
            return (bool) $this->getData(ResourceInterface::FIELD_REQUIRES_AVAILABILITY_QUANTITY);
        }

        /**
         * @inheritdoc
         */
        public function setRequiresAvailableQuantity(bool $requiresAvailableQuantity): self
        {
            return $this->setData(ResourceInterface::FIELD_REQUIRES_AVAILABILITY_QUANTITY, $requiresAvailableQuantity);
        }
    }
?>