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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemResourceInterface;

    class LineItem
    extends AbstractResource
    implements LineItemResourceInterface
    {
        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzmarketplace_lineitem';

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
        public function saveLineItem(LineItemInterface $lineItem): LineItemResourceInterface
        {
            return $this->saveModel($lineItem);
        }

        /**
         * {@inheritdoc}
         */
        public function loadLineItemById(LineItemInterface $lineItem, $id): LineItemResourceInterface
        {
            return $this->loadModelById($lineItem, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function loadLineItemBySkroutzId(LineItemInterface $lineItem, string $skroutzId): LineItemResourceInterface
        {
            return $this->loadModel($lineItem, $skroutzId, static::FIELD_SKROUTZ_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteLineItem(LineItemInterface $lineItem): bool
        {
            return $this->deleteModel($lineItem);
        }
    }
?>