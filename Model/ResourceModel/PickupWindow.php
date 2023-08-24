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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupWindowResourceInterface;

    class PickupWindow
    extends AbstractResource
    implements PickupWindowResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzmarketplace_pickupwindow';

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
        public function savePickupWindow(PickupWindowInterface $pickupWindow): self
        {
            return $this->saveModel($pickupWindow);
        }

        /**
         * {@inheritdoc}
         */
        public function loadPickupWindowById(PickupWindowInterface $pickupWindow, $id): self
        {
            return $this->loadModelById($pickupWindow, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function loadPickupWindowBySkroutzId(PickupWindowInterface $pickupWindow, int $skroutzId): self
        {
            return $this->loadModel($pickupWindow, $skroutzId, static::FIELD_SKROUTZ_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deletePickupWindow(PickupWindowInterface $pickupWindow): bool
        {
            return $this->deleteModel($pickupWindow);
        }
    }
?>