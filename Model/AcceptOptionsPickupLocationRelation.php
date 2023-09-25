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

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface as ResourceInterface;

    class AcceptOptionsPickupLocationRelation
    extends AbstractModel
    implements AcceptOptionsPickupLocationRelationInterface
    {
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

            $this->acceptOptionsRepository = $acceptOptionsRepository;
            $this->pickupLocationRepository = $pickupLocationRepository;

            $this->acceptOptions = null;
            $this->pickupLocation = null;
        }

        /**
         * Accept Options
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface|null $acceptOptions
         */
        private $acceptOptions;

        /**
         * @inheritdoc
         */
        public function getAcceptOptions(): AcceptOptionsInterface
        {
            $acceptOptions = $this->acceptOptions;
            if($acceptOptions === null)
            {
                $acceptOptions = $this->getAcceptOptionsRepository()->getById($this->getData(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID));
                $this->acceptOptions = $acceptOptions;
            }
            return $acceptOptions;
        }

        /**
         * @inheritdoc
         */
        public function setAcceptOptions(AcceptOptionsInterface $acceptOptions): AcceptOptionsPickupLocationRelation
        {
            $this->acceptOptions = $acceptOptions;
            return $this->setData(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID, $acceptOptions->getId());
        }

        /**
         * Pickup Location
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface|null $pickupLocation
         */
        private $pickupLocation;

        /**
         * @inheritdoc
         */
        public function getPickupLocation(): PickupLocationInterface
        {
            $pickupLocation = $this->pickupLocation;
            if($pickupLocation === null)
            {
                $pickupLocation = $this->getPickupLocationRepository()->getById($this->getData(ResourceInterface::FIELD_PICKUP_LOCATION_ID));
                $this->pickupLocation = $pickupLocation;
            }
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function setPickupLocation(PickupLocationInterface $pickupLocation): AcceptOptionsPickupLocationRelation
        {
            $this->pickupLocation = $pickupLocation;
            return $this->setData(ResourceInterface::FIELD_PICKUP_LOCATION_ID, $pickupLocation->getId());
        }

        /**
         * Accept Options Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
         */
        private $acceptOptionsRepository;

        /**
         * Gets Accept Options Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface
         */
        protected function getAcceptOptionsRepository(): AcceptOptionsRepositoryInterface
        {
            return $this->acceptOptionsRepository;
        }

        /**
         * Accept Options Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface $acceptOptionsRepository
         */
        private $pickupLocationRepository;

        /**
         * Gets Pickup Location Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface
         */
        protected function getPickupLocationRepository(): PickupLocationRepositoryInterface
        {
            return $this->pickupLocationRepository;
        }
    }
?>