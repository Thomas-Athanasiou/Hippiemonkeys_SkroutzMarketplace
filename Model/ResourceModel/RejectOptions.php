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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface;

    class RejectOptions
    extends AbstractRelationResource
    implements RejectOptionsResourceInterface
    {
        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzmarketplace_rejectoptions';

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
        public function saveRejectOptions(RejectOptionsInterface $rejectOptions): self
        {
            return $this->saveModel($rejectOptions);
        }

        /**
         * {@inheritdoc}
         */
        public function loadRejectOptionsById(RejectOptionsInterface $rejectOptions, $id): self
        {
            return $this->loadModelById($rejectOptions, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function loadRejectOptionsByOrderId(RejectOptionsInterface $rejectOptions, $orderId): self
        {
            return $this->loadModel($rejectOptions, $orderId, static::FIELD_ORDER_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteRejectOptions(RejectOptionsInterface $rejectOptions): bool
        {
            return $this->deleteModel($rejectOptions);
        }
    }
?>