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
        Magento\Framework\Api\SearchCriteriaBuilder,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\AcceptOptions as ResourceModel;

    class AcceptOptions
    extends AbstractModel
    implements AcceptOptionsInterface
    {
        public const
            FIELD_ORDER = 'order',
            ACCEPT_OPTIONS_PICKUP_LOCATION_RELATION_FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id',
            ACCEPT_OPTIONS_PICKUP_WINDOW_RELATION_FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface $acceptOptionsPickupLocationRelationRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface $acceptOptionsPickupWindowRelationRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            AcceptOptionsPickupLocationRelationRepositoryInterface $acceptOptionsPickupLocationRelationRepository,
            AcceptOptionsPickupWindowRelationRepositoryInterface $acceptOptionsPickupWindowRelationRepository,
            OrderRepositoryInterface $orderRepository,
            SearchCriteriaBuilder $searchCriteriaBuilder,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

            $this->_acceptOptionsPickupLocationRelationRepository = $acceptOptionsPickupLocationRelationRepository;
            $this->_acceptOptionsPickupWindowRelationRepository = $acceptOptionsPickupWindowRelationRepository;
            $this->_orderRepository = $orderRepository;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * {@inheritdoc}
         */
        public function getNumberOfParcels() : array
        {
            return explode(';', $this->getData(ResourceModel::FIELD_NUMBER_OF_PARCELS));
        }

        /**
         * {@inheritdoc}
         */
        public function setNumberOfParcels(array $numberOfParcels): AcceptOptions
        {
            return $this->setData(ResourceModel::FIELD_NUMBER_OF_PARCELS, implode(';', $numberOfParcels));
        }

        /**
         * {@inheritdoc}
         */
        public function getOrder(): OrderInterface
        {
            $order = $this->getData(static::FIELD_ORDER);
            if ($order === null)
            {
                $order = $this->getOrderRepository()->getById(
                    $this->getData(ResourceModel::FIELD_ORDER_ID)
                );
                $this->setData(static::FIELD_ORDER, $order);
            }
            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function setOrder(OrderInterface $order): AcceptOptions
        {
            $this->setData(ResourceModel::FIELD_ORDER_ID, $order->getId());
            return $this->setData(static::FIELD_ORDER, $order);
        }

        /**
         * {@inheritdoc}
         */
        public function getPickupLocation(): array
        {
            $pickupLocation = $this->getData(ResourceModel::FIELD_PICKUP_LOCATION);
            if ($pickupLocation === null)
            {
                $pickupLocation = [];
                $acceptOptionsPickupLocationRelations = $this->getAcceptOptionsPickupLocationRelationRepository()
                    ->getList(
                        $this->getSearchCriteriaBuilder()
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
         * {@inheritdoc}
         */
        public function setPickupLocation(array $pickupLocation): AcceptOptions
        {
            return $this->setData(ResourceModel::FIELD_PICKUP_LOCATION, $pickupLocation);
        }

        /**
         * {@inheritdoc}
         */
        public function getPickupWindow(): array
        {
            $pickupWindow = $this->getData(ResourceModel::FIELD_PICKUP_WINDOW);
            if (!$pickupWindow) {
                $pickupWindow = [];
                $acceptOptionsPickupWindowRelations = $this->getAcceptOptionsPickupWindowRelationRepository()
                    ->getList(
                        $this->getSearchCriteriaBuilder()
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
         * {@inheritdoc}
         */
        public function setPickupWindow(array $pickupWindow): AcceptOptions
        {
            return $this->setData(ResourceModel::FIELD_PICKUP_WINDOW, $pickupWindow);
        }

        /**
         * Accept Options Pickup Location Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface $_orderRepository
         */
        private $_acceptOptionsPickupLocationRelationRepository;

        /**
         * Gets Accept Options Pickup Location Relation Repository
         *
         * @access protected
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface $_orderRepository
         */
        protected function getAcceptOptionsPickupLocationRelationRepository(): AcceptOptionsPickupLocationRelationRepositoryInterface
        {
            return $this->_acceptOptionsPickupLocationRelationRepository;
        }

        /**
         * Accept Options Pickup Window Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface $_orderRepository
         */
        private $_acceptOptionsPickupWindowRelationRepository;

        /**
         * Gets Accept Options Pickup Window Relation Repository
         *
         * @access protected
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface $_orderRepository
         */
        protected function getAcceptOptionsPickupWindowRelationRepository(): AcceptOptionsPickupWindowRelationRepositoryInterface
        {
            return $this->_acceptOptionsPickupWindowRelationRepository;
        }

        /**
         * Order Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $_orderRepository
         */
        private $_orderRepository;

        /**
         * Gets Order Repository
         *
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        protected function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->_orderRepository;
        }

        /**
         * Search Criteria Builder property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteriaBuilder $_searchCriteriaBuilder
         */
        private $_searchCriteriaBuilder;

        /**
         * Gets Search Criteria Builder
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected function getSearchCriteriaBuilder(): SearchCriteriaBuilder
        {
            return $this->_searchCriteriaBuilder;
        }
    }
?>