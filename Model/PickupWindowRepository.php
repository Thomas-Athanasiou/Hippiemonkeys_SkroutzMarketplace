<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\PickupWindowRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\PickupWindow as ResourceModel;

    class PickupWindowRepository
    implements PickupWindowRepositoryInterface
    {
        protected
            $_localIdIndex      = [],
            $_skroutzIdIndex    = [];

        public function __construct(
            ResourceModel $resourceModel,
            PickupWindowInterfaceFactory $pickupWindowFactory
        )
        {
            $this->_resourceModel       = $resourceModel;
            $this->_pickupWindowFactory = $pickupWindowFactory;
        }

        /**
         * @inheritdoc
         */
        public function getByLocalId(int $localId) : PickupWindowInterface
        {
            $pickupWindow = $this->_localIdIndex[$localId] ?? null;
            if(!$pickupWindow)
            {
                $pickupWindow = $this->getPickupWindowFactory()->create();
                $this->getResourceModel()->load($pickupWindow, $localId, ResourceModel::FIELD_ID);
                $localId = $pickupWindow->getLocalId();
                if (!$localId)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Window with id "%1" that was requested doesn\'t exist. Verify the pickupWindow and try again.', $localId)
                    );
                }
                $this->_localIdIndex[$localId]                              = $pickupWindow;
                $this->_skroutzIdIndex[ $pickupWindow->getBySkroutzId() ]   = $pickupWindow;
            }
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(int $skroutzId) : PickupWindowInterface
        {
            $pickupWindow = $this->_skroutzIdIndex[$skroutzId] ?? null;
            if(!$pickupWindow)
            {
                $pickupWindow = $this->getPickupWindowFactory()->create();
                $this->getResourceModel()->load($pickupWindow, $skroutzId, ResourceModel::FIELD_SKROUTZ_ID);
                $localId = $pickupWindow->getLocalId();
                if (!$localId)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Window with skroutz id "%1" that was requested doesn\'t exist. Verify the pickupWindow and try again.', $skroutzId)
                    );
                }
                $this->_localIdIndex[$localId]      = $pickupWindow;
                $this->_skroutzIdIndex[$skroutzId]  = $pickupWindow;
            }
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function save(PickupWindowInterface $pickupWindow) : PickupWindowInterface
        {
            $this->getResourceModel()->save($pickupWindow);
            $this->_skroutzIdIndex[ $pickupWindow->getBySkroutzId() ]   = $pickupWindow;
            $this->_localIdIndex[ $pickupWindow->getLocalId() ]              = $pickupWindow;
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function delete(PickupWindowInterface $pickupWindow) : bool
        {
            $this->getResourceModel()->delete($pickupWindow);
            unset( $this->_localIdIndex[ $pickupWindow->getLocalId() ] );
            unset( $this->_skroutzIdIndex[ $pickupWindow->getSkroutzId() ] );
            return $pickupWindow->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_pickupWindowFactory;
        protected function getPickupWindowFactory() : PickupWindowInterfaceFactory
        {
            return $this->_pickupWindowFactory;
        }
    }
?>