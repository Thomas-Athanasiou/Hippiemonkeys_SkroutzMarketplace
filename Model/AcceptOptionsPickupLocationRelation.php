<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\AbstractResource,
        Magento\Framework\Data\Collection\AbstractDb,

        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\PickupLocationRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptionsPickupLocationRelation as ResourceModel;

    class AcceptOptionsPickupLocationRelation
    extends AbstractModel
    implements AcceptOptionsPickupLocationRelationInterface
    {
        public const
            FIELD_ACCEPT_OPTIONS        = 'accept_options',
            FIELD_PICKUP_LOCATION       = 'pickup_location';

        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository,
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\PickupLocationRepositoryInterface $pickupLocationRepository,
         * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
         * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,

            AcceptOptionsRepositoryInterface $acceptOptionsRepository,
            PickupLocationRepositoryInterface $pickupLocationRepository,

            AbstractResource $resource = null,
            AbstractDb $resourceCollection = null,
            array $data = []
        )
        {
            parent::__construct(
                $context,
                $registry,
                $resource,
                $resourceCollection,
                $data
            );
            $this->_acceptOptionsRepository     = $acceptOptionsRepository;
            $this->_pickupLocationRepository    = $pickupLocationRepository;
        }

        /**
         * @inheritdoc
         */
        public function getAcceptOptions(): AcceptOptionsInterface
        {
            $acceptOptions      = $this->getData(self::FIELD_ACCEPT_OPTIONS);
            $acceptOptionsId    = $this->getData(ResourceModel::FIELD_ACCEPT_OPTIONS_ID);
            if(!$acceptOptions && $acceptOptionsId)
            {
                $acceptOptions = $this->getAcceptOptionsRepository()->getById($acceptOptionsId);
                $this->setData(self::FIELD_ACCEPT_OPTIONS, $acceptOptions);
            }
            return $acceptOptions;
        }

        /**
         * @inheritdoc
         */
        public function setAcceptOptions(AcceptOptionsInterface $acceptOptions)
        {
            $this->setData(ResourceModel::FIELD_ACCEPT_OPTIONS_ID, $acceptOptions->getId());
            return $this->setData(self::FIELD_ACCEPT_OPTIONS, $acceptOptions);
        }

        /**
         * @inheritdoc
         */
        public function getPickupLocation(): PickupLocationInterface
        {
            $pickupLocation     = $this->getData(self::FIELD_PICKUP_LOCATION);
            $pickupLocationId   = $this->getData(ResourceModel::FIELD_PICKUP_LOCATION_ID);
            if(!$pickupLocation && $pickupLocationId)
            {
                $pickupLocation = $this->getPickupLocationRepository()->getById($pickupLocationId);
                $this->setData(self::FIELD_PICKUP_LOCATION, $pickupLocation);
            }
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function setPickupLocation(PickupLocationInterface $pickupLocation)
        {
            $this->setData(ResourceModel::FIELD_PICKUP_LOCATION_ID, $pickupLocation->getId());
            return $this->setData(self::FIELD_PICKUP_LOCATION, $pickupLocation);
        }

        /**
         * @var Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface $_acceptOptionsRepository
         */
        private $_acceptOptionsRepository;
        /**
         * Gets Accept Options Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface
         */
        protected function getAcceptOptionsRepository(): AcceptOptionsRepositoryInterface
        {
            return $this->_acceptOptionsRepository;
        }

        /**
         * @var \Hippiemonkeys\SkroutzSmartCart\Api\PickupLocationRepositoryInterface $_acceptOptionsRepository
         */
        private $_pickupLocationRepository;
        /**
         * Gets Pickup Location Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\PickupLocationRepositoryInterface
         */
        protected function getPickupLocationRepository(): PickupLocationRepositoryInterface
        {
            return $this->_pickupLocationRepository;
        }
    }
?>