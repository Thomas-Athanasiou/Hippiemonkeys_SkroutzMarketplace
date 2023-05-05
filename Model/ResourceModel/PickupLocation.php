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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupLocationResourceInterface;

    class PickupLocation
    extends AbstractResource
    implements PickupLocationResourceInterface
    {
        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzmarketplace_pickuplocation';

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
        public function savePickupLocation(PickupLocationInterface $pickupLocation): PickupLocationResourceInterface
        {
            return $this->saveModel($pickupLocation);
        }

        /**
         * {@inheritdoc}
         */
        public function loadPickupLocationById(PickupLocationInterface $pickupLocation, $id): PickupLocationResourceInterface
        {
            return $this->loadModelById($pickupLocation, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function loadPickupLocationBySkroutzId(PickupLocationInterface $pickupLocation, string $skroutzId): PickupLocationResourceInterface
        {
            return $this->loadModel($pickupLocation, $skroutzId, static::FIELD_SKROUTZ_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function deletePickupLocation(PickupLocationInterface $pickupLocation): bool
        {
            return $this->deleteModel($pickupLocation);
        }
    }
?>