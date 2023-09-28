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

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractRelationResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface;

    class Order
    extends AbstractRelationResource
    implements OrderResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzmarketplace_order';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        /**
         * @inheritdoc
         */
        public function saveOrder(OrderInterface $order): self
        {
            return $this->saveModel($order);
        }

        /**
         * @inheritdoc
         */
        public function loadOrderById(OrderInterface $order, $id): self
        {
            return $this->loadModelById($order, $id);
        }

        /**
         * @inheritdoc
         */
        public function loadOrderByCode(OrderInterface $order, string $code): self
        {
            return $this->loadModel($order, $code, static::FIELD_CODE);
        }

        /**
         * @inheritdoc
         */
        public function loadOrderByMagentoOrderId(OrderInterface $order, $magentoOrderId): self
        {
            return $this->loadModel($order, $magentoOrderId, static::FIELD_MAGENTO_ORDER_ID);
        }

        /**
         * @inheritdoc
         */
        public function deleteOrder(OrderInterface $order): bool
        {
            return $this->deleteModel($order);
        }
    }
?>