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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderPickupWindowResourceInterface;

    class OrderPickupWindow
    extends AbstractResource
    implements OrderPickupWindowResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzmarketplace_orderpickupwindow';

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
        public function saveOrderPickupWindow(OrderPickupWindowInterface $orderPickupWindow): OrderPickupWindowResourceInterface
        {
            return $this->saveModel($orderPickupWindow);
        }

        /**
         * {@inheritdoc}
         */
        public function loadOrderPickupWindowById(OrderPickupWindowInterface $orderPickupWindow, $id): OrderPickupWindowResourceInterface
        {
            return $this->loadModelById($orderPickupWindow, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteOrderPickupWindow(OrderPickupWindowInterface $orderPickupWindow): bool
        {
            return $this->deleteModel($orderPickupWindow);
        }
    }
?>