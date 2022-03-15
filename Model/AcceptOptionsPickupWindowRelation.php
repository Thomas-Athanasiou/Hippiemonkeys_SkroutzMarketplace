<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Model\AbstractModel,

        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\PickupWindowRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptionsPickupWindowRelation as ResourceModel;

    class AcceptOptionsPickupWindowRelation
    extends AbstractModel
    implements AcceptOptionsPickupWindowRelationInterface
    {
        public const
            FIELD_ACCEPT_OPTIONS    = 'accept_options',
            FIELD_PICKUP_WINDOW     = 'pickup_window';

        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @param \Magento\Framework\Model\Context $context,
         * @param \Magento\Framework\Registry $registry,
         * @param AcceptOptionsRepositoryInterface $acceptOptionsRepository,
         * @param PickupWindowRepositoryInterface $pickupWindowRepository,
         * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource,
         * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection,
         * @param array $data
         */
        public function __construct(
            \Magento\Framework\Model\Context $context,
            \Magento\Framework\Registry $registry,

            AcceptOptionsRepositoryInterface $acceptOptionsRepository,
            PickupWindowRepositoryInterface $pickupWindowRepository,

            \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
            \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
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
            $this->_acceptOptionsRepository = $acceptOptionsRepository;
            $this->_pickupWindowRepository = $pickupWindowRepository;
        }

        /**
         * @inheritdoc
         */
        public function getAcceptOptions(): AcceptOptionsInterface
        {
            $acceptOptions = $this->getData(self::FIELD_ACCEPT_OPTIONS);
            $acceptOptionsId    = $this->getData(ResourceModel::FIELD_ACCEPT_OPTIONS_ID);
            if(!$acceptOptions && $acceptOptionsId)
            {
                $acceptOptions      = $this->getAcceptOptionsRepository()->getById($acceptOptionsId);
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
        public function getPickupWindow(): PickupWindowInterface
        {
            $pickupWindow   = $this->getData(self::FIELD_PICKUP_WINDOW);
            $pickupWindowId = $this->getData(ResourceModel::FIELD_PICKUP_WINDOW_ID);
            if(!$pickupWindow && $pickupWindowId)
            {
                $pickupWindow     = $this->getPickupWindowRepository()->getById($pickupWindowId);
                $this->setData(self::FIELD_PICKUP_WINDOW, $pickupWindow);
            }
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function setPickupWindow(PickupWindowInterface $pickupWindow)
        {
            $this->setData(ResourceModel::FIELD_PICKUP_WINDOW_ID, $pickupWindow->getId());
            return $this->setData(self::FIELD_PICKUP_WINDOW, $pickupWindow);
        }

        private $_acceptOptionsRepository;
        protected function getAcceptOptionsRepository(): AcceptOptionsRepositoryInterface
        {
            return $this->_acceptOptionsRepository;
        }

        private $_pickupWindowRepository;
        protected function getPickupWindowRepository(): PickupWindowRepositoryInterface
        {
            return $this->_pickupWindowRepository;
        }
    }
?>