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

    use Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\PickupLocation as ResourceModel;

    class PickupLocationRepository
    implements PickupLocationRepositoryInterface
    {
        protected
            $_localIdIndex      = [],
            $_skroutzIdIndex    = [];

        public function __construct(
            ResourceModel $resourceModel,
            PickupLocationInterfaceFactory $pickupLocationFactory
        )
        {
            $this->_resourceModel           = $resourceModel;
            $this->_pickupLocationFactory   = $pickupLocationFactory;
        }

        /**
         * @inheritdoc
         */
        public function getByLocalId(int $localId) : PickupLocationInterface
        {
            $pickupLocation = $this->_localIdIndex[$localId] ?? null;
            if(!$pickupLocation)
            {
                $pickupLocation = $this->getPickupLocationFactory()->create();
                $this->getResourceModel()->load($pickupLocation, $localId, ResourceModel::FIELD_ID);
                $localId = $pickupLocation->getLocalId();
                if (!$localId)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Location with id "%1" that was requested doesn\'t exist. Verify the pickupLocation and try again.', $localId)
                    );
                }
                $this->_localIdIndex[$localId]                              = $pickupLocation;
                $this->_skroutzIdIndex[ $pickupLocation->getSkroutzId() ]   = $pickupLocation;
            }
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(string $skroutzId) : PickupLocationInterface
        {
            $pickupLocation = $this->_skroutzIdIndex[$skroutzId] ?? null;
            if(!$pickupLocation)
            {
                $pickupLocation = $this->getPickupLocationFactory()->create();
                $this->getResourceModel()->load($pickupLocation, $skroutzId, ResourceModel::FIELD_SKROUTZ_ID);
                $localId = $pickupLocation->getLocalId();
                if (!$localId)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Location with skroutz id "%1" that was requested doesn\'t exist. Verify the pickupLocation and try again.', $skroutzId)
                    );
                }
                $this->_localIdIndex[$localId]      = $pickupLocation;
                $this->_skroutzIdIndex[$skroutzId]  = $pickupLocation;
            }
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function save(PickupLocationInterface $pickupLocation) : PickupLocationInterface
        {
            $this->getResourceModel()->save($pickupLocation);
            $this->_skroutzIdIndex[ $pickupLocation->getBySkroutzId() ] = $pickupLocation;
            $this->_localIdIndex[ $pickupLocation->getLocalId() ]       = $pickupLocation;
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function delete(PickupLocationInterface $pickupLocation) : bool
        {
            $this->getResourceModel()->delete($pickupLocation);
            unset( $this->_localIdIndex[ $pickupLocation->getLocalId() ] );
            unset( $this->_skroutzIdIndex[ $pickupLocation->getSkroutzId() ] );
            return $pickupLocation->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_pickupLocationFactory;
        protected function getPickupLocationFactory() : PickupLocationInterfaceFactory
        {
            return $this->_pickupLocationFactory;
        }
    }
?>