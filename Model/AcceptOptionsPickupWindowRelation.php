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

    use Magento\Framework\Model\Context,
        Magento\Framework\Registry,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupWindowRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupWindowRelationResourceInterface as ResourceInterface;

    class AcceptOptionsPickupWindowRelation
    extends AbstractModel
    implements AcceptOptionsPickupWindowRelationInterface
    {
        protected const
            FIELD_ACCEPT_OPTIONS = 'accept_options',
            FIELD_PICKUP_WINDOW = 'pickup_window';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\PickupWindowRepositoryInterface $pickupWindowRepository
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            AcceptOptionsRepositoryInterface $acceptOptionsRepository,
            PickupWindowRepositoryInterface $pickupWindowRepository,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);
            $this->acceptOptionsRepository = $acceptOptionsRepository;
            $this->pickupWindowRepository = $pickupWindowRepository;
        }

        /**
         * @inheritdoc
         */
        public function getAcceptOptions(): AcceptOptionsInterface
        {
            $acceptOptions = $this->getData(static::FIELD_ACCEPT_OPTIONS);
            if($acceptOptions === null)
            {
                $acceptOptions = $this->getAcceptOptionsRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID)
                );
                $this->setData(static::FIELD_ACCEPT_OPTIONS, $acceptOptions);
            }
            return $acceptOptions;
        }

        /**
         * @inheritdoc
         */
        public function setAcceptOptions(AcceptOptionsInterface $acceptOptions): AcceptOptionsPickupWindowRelation
        {
            $this->setData(ResourceInterface::FIELD_ACCEPT_OPTIONS_ID, $acceptOptions->getId());
            return $this->setData(static::FIELD_ACCEPT_OPTIONS, $acceptOptions);
        }

        /**
         * @inheritdoc
         */
        public function getPickupWindow(): PickupWindowInterface
        {
            $pickupWindow = $this->getData(static::FIELD_PICKUP_WINDOW);
            if($pickupWindow === null)
            {
                $pickupWindow = $this->getPickupWindowRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_PICKUP_WINDOW_ID)
                );
                $this->setData(static::FIELD_PICKUP_WINDOW, $pickupWindow);
            }
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function setPickupWindow(PickupWindowInterface $pickupWindow): AcceptOptionsPickupWindowRelation
        {
            $this->setData(ResourceInterface::FIELD_PICKUP_WINDOW_ID, $pickupWindow->getId());
            return $this->setData(static::FIELD_PICKUP_WINDOW, $pickupWindow);
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
         * Pickup Window Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\PickupWindowRepositoryInterface
         */
        private $pickupWindowRepository;

        /**
         * Gets Pickup Window Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupWindowRepositoryInterface
         */
        protected function getPickupWindowRepository(): PickupWindowRepositoryInterface
        {
            return $this->pickupWindowRepository;
        }
    }
?>