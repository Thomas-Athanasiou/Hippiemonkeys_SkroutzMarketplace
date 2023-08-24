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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemRejectionReasonResourceInterface;

    class LineItemRejectionReason
    extends AbstractResource
    implements LineItemRejectionReasonResourceInterface
    {
        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzmarketplace_lineitemrejectionreason';

        /**
         * {@inheritdoc}
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function saveLineItemRejectionReason(LineItemRejectionReasonInterface $lineItemRejectionReason): self
        {
            return $this->saveModel($lineItemRejectionReason);
        }

        /**
         * {@inheritdoc}
         */
        public function loadLineItemRejectionReasonById(LineItemRejectionReasonInterface $lineItemRejectionReason, $id): self
        {
            return $this->loadModelById($lineItemRejectionReason, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function loadLineItemRejectionReasonBySkroutzId(LineItemRejectionReasonInterface $lineItemRejectionReason, int $skroutzId): self
        {
            return $this->loadModel($lineItemRejectionReason, $skroutzId, static::FIELD_SKROUTZ_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteLineItemRejectionReason(LineItemRejectionReasonInterface $lineItemRejectionReason): bool
        {
            return $this->deleteModel($lineItemRejectionReason);
        }
    }
?>