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

    use Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\AcceptOptionsPickupLocationRelation as ResourceModel;

    class AcceptOptionsPickupLocationRelation
    extends AbstractModel
    implements AcceptOptionsPickupLocationRelationInterface
    {
        protected const
            FIELD_ACCEPT_OPTIONS = 'accept_options',
            FIELD_PICKUP_LOCATION = 'pickup_location';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface $pickupLocationRepository
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            AcceptOptionsRepositoryInterface $acceptOptionsRepository,
            PickupLocationRepositoryInterface $pickupLocationRepository,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

            $this->_acceptOptionsRepository     = $acceptOptionsRepository;
            $this->_pickupLocationRepository    = $pickupLocationRepository;
        }

        /**
         * {@inheritdoc}
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
         * {@inheritdoc}
         */
        public function setAcceptOptions(AcceptOptionsInterface $acceptOptions): AcceptOptionsPickupLocationRelation
        {
            $this->setData(ResourceModel::FIELD_ACCEPT_OPTIONS_ID, $acceptOptions->getId());
            return $this->setData(self::FIELD_ACCEPT_OPTIONS, $acceptOptions);
        }

        /**
         * {@inheritdoc}
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
         * {@inheritdoc}
         */
        public function setPickupLocation(PickupLocationInterface $pickupLocation): AcceptOptionsPickupLocationRelation
        {
            $this->setData(ResourceModel::FIELD_PICKUP_LOCATION_ID, $pickupLocation->getId());
            return $this->setData(self::FIELD_PICKUP_LOCATION, $pickupLocation);
        }

        /**
         * Accept Options Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $_acceptOptionsRepository
         */
        private $_acceptOptionsRepository;

        /**
         * Gets Accept Options Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface
         */
        protected function getAcceptOptionsRepository(): AcceptOptionsRepositoryInterface
        {
            return $this->_acceptOptionsRepository;
        }

        /**
         * Accept Options Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface $_acceptOptionsRepository
         */
        private $_pickupLocationRepository;

        /**
         * Gets Pickup Location Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface
         */
        protected function getPickupLocationRepository(): PickupLocationRepositoryInterface
        {
            return $this->_pickupLocationRepository;
        }
    }
?>