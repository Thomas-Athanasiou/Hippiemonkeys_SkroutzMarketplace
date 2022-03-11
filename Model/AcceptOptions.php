<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\AbstractResource,
        Magento\Framework\Data\Collection\AbstractDb,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsPickupLocationRelationRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsPickupWindowRelationRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptions as ResourceModel;

    class AcceptOptions
    extends AbstractModel
    implements AcceptOptionsInterface
    {
        public const
            FIELD_ORDER = 'order',

            ACCEPT_OPTIONS_PICKUP_LOCATION_RELATION_FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id',
            ACCEPT_OPTIONS_PICKUP_WINDOW_RELATION_FIELD_ACCEPT_OPTIONS_ID   = 'accept_options_id';

        /**
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsPickupLocationRelationRepositoryInterface $acceptOptionsPickupLocationRelationRepository
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsPickupWindowRelationRepositoryInterface $acceptOptionsPickupWindowRelationRepository
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\OrderRepositoryInterface $orderRepository
         * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
         * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            AcceptOptionsPickupLocationRelationRepositoryInterface $acceptOptionsPickupLocationRelationRepository,
            AcceptOptionsPickupWindowRelationRepositoryInterface $acceptOptionsPickupWindowRelationRepository,
            OrderRepositoryInterface $orderRepository,
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
            $this->_acceptOptionsPickupLocationRelationRepository   = $acceptOptionsPickupLocationRelationRepository;
            $this->_acceptOptionsPickupWindowRelationRepository     = $acceptOptionsPickupWindowRelationRepository;
            $this->_orderRepository                                 = $orderRepository;
        }

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getNumberOfParcels() : array
        {
            return explode(';', $this->getData(ResourceModel::FIELD_NUMBER_OF_PARCELS));
        }

        /**
         * @inheritdoc
         */
        public function setNumberOfParcels(array $numberOfParcels)
        {
            return $this->setData(ResourceModel::FIELD_NUMBER_OF_PARCELS, implode(';', $numberOfParcels));
        }

        /**
         * @inheritdoc
         */
        public function getOrder(): OrderInterface
        {
            $order      = $this->getData(self::FIELD_ORDER);
            $orderId    = $this->getData(ResourceModel::FIELD_ORDER_ID);
            if (!$order && $orderId)
            {
                $order = $this->getOrderRepository()->getById((int) $orderId);
                $this->setOrder($order);
            }
            return $order;
        }

        /**
         * @inheritdoc
         */
        public function setOrder(OrderInterface $order)
        {
            $this->setData(ResourceModel::FIELD_ORDER_ID, $order->getId());
            return $this->setData(self::FIELD_ORDER, $order);
        }

        /**
         * @inheritdoc
         */
        public function getPickupLocation(): array
        {
            $pickupLocation = $this->getData(ResourceModel::FIELD_PICKUP_LOCATION);
            if (!$pickupLocation) {
                $pickupLocation = [];
                $acceptOptionsPickupLocationRelations = $this->getAcceptOptionsPickupLocationRelationRepository()
                    ->getList(
                        $this->getSearchCriteriaBuilderFactory()
                            ->create()
                            ->addFilter(self::ACCEPT_OPTIONS_PICKUP_LOCATION_RELATION_FIELD_ACCEPT_OPTIONS_ID, $this->getId())
                            ->create()
                    )
                    ->getItems();
                foreach($acceptOptionsPickupLocationRelations as $acceptOptionsPickupLocationRelation)
                {
                    $pickupLocation[] = $acceptOptionsPickupLocationRelation->getPickupLocation();
                }
                $this->setPickupLocation($pickupLocation);
            }
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function setPickupLocation(array $pickupLocation)
        {
            return $this->setData(ResourceModel::FIELD_PICKUP_LOCATION, $pickupLocation);
        }

        /**
         * @inheritdoc
         */
        public function getPickupWindow(): array
        {
            $pickupWindow = $this->getData(ResourceModel::FIELD_PICKUP_WINDOW);
            if (!$pickupWindow) {
                $pickupWindow = [];
                $acceptOptionsPickupWindowRelations = $this->getAcceptOptionsPickupWindowRelationRepository()
                    ->getList(
                        $this->getSearchCriteriaBuilderFactory()
                            ->create()
                            ->addFilter(self::ACCEPT_OPTIONS_PICKUP_WINDOW_RELATION_FIELD_ACCEPT_OPTIONS_ID, $this->getId())
                            ->create()
                    )
                    ->getItems();
                foreach($acceptOptionsPickupWindowRelations as $acceptOptionsPickupWindowRelation)
                {
                    $pickupWindow[] = $acceptOptionsPickupWindowRelation->getPickupWindow();
                }
                $this->setPickupWindow($pickupWindow);
            }
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function setPickupWindow(array $pickupWindow)
        {
            return $this->setData(ResourceModel::FIELD_PICKUP_WINDOW, $pickupWindow);
        }

        private $_acceptOptionsPickupLocationRelationRepository;
        protected function getAcceptOptionsPickupLocationRelationRepository(): AcceptOptionsPickupLocationRelationRepositoryInterface
        {
            return $this->_acceptOptionsPickupLocationRelationRepository;
        }

        private $_acceptOptionsPickupWindowRelationRepository;
        protected function getAcceptOptionsPickupWindowRelationRepository(): AcceptOptionsPickupWindowRelationRepositoryInterface
        {
            return $this->_acceptOptionsPickupWindowRelationRepository;
        }

        private $_orderRepository;
        protected function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->_orderRepository;
        }
    }
?>