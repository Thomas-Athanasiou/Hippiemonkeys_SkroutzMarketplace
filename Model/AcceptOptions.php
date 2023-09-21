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
        Magento\Framework\Api\SearchCriteriaBuilder,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsResourceInterface as ResourceInterface;

    class AcceptOptions
    extends AbstractModel
    implements AcceptOptionsInterface
    {
        public const
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

            $this->acceptOptionsPickupLocationRelationRepository = $acceptOptionsPickupLocationRelationRepository;
            $this->acceptOptionsPickupWindowRelationRepository = $acceptOptionsPickupWindowRelationRepository;
            $this->orderRepository = $orderRepository;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;

            $this->order = null;
        }

        /**
         * @inheritdoc
         * @final
         */
        public final function getNumberOfParcels() : array
        {
            return explode(';', $this->getData(ResourceInterface::FIELD_NUMBER_OF_PARCELS));
        }

        /**
         * @inheritdoc
         * @final
         */
        public final function setNumberOfParcels(array $numberOfParcels): AcceptOptions
        {
            return $this->setData(ResourceInterface::FIELD_NUMBER_OF_PARCELS, implode(';', $numberOfParcels));
        }


        /**
         * Order Property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         */
        private $order;

        /**
         * @inheritdoc
         * @final
         */
        public final function getOrder(): OrderInterface
        {
            $order = $this->order;
            if ($order === null)
            {
                $order = $this->getOrderRepository()->getById($this->getData(ResourceInterface::FIELD_ORDER_ID));
                $this->order = $order;
            }
            return $order;
        }

        /**
         * @inheritdoc
         * @final
         */
        public final function setOrder(OrderInterface $order): AcceptOptions
        {
            $this->order = $order;
            return $this->setData(ResourceInterface::FIELD_ORDER_ID, $order->getId());
        }

        /**
         * @inheritdoc
         * @final
         */
        public final function getPickupLocation(): array
        {
            $pickupLocation = $this->getData(ResourceInterface::FIELD_PICKUP_LOCATION);
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
         * @inheritdoc
         * @final
         */
        public final function setPickupLocation(array $pickupLocation): AcceptOptions
        {
            return $this->setData(ResourceInterface::FIELD_PICKUP_LOCATION, $pickupLocation);
        }

        /**
         * @inheritdoc
         * @final
         */
        public final function getPickupWindow(): array
        {
            $pickupWindow = $this->getData(ResourceInterface::FIELD_PICKUP_WINDOW);
            if (!$pickupWindow)
            {
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
         * @inheritdoc
         * @final
         */
        public final function setPickupWindow(array $pickupWindow): AcceptOptions
        {
            return $this->setData(ResourceInterface::FIELD_PICKUP_WINDOW, $pickupWindow);
        }

        /**
         * Accept Options Pickup Location Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface $acceptOptionsPickupLocationRelationRepository
         */
        private $acceptOptionsPickupLocationRelationRepository;

        /**
         * Gets Accept Options Pickup Location Relation Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface
         */
        protected final function getAcceptOptionsPickupLocationRelationRepository(): AcceptOptionsPickupLocationRelationRepositoryInterface
        {
            return $this->acceptOptionsPickupLocationRelationRepository;
        }

        /**
         * Accept Options Pickup Window Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface $acceptOptionsPickupWindowRelationRepository
         */
        private $acceptOptionsPickupWindowRelationRepository;

        /**
         * Gets Accept Options Pickup Window Relation Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface
         */
        protected final function getAcceptOptionsPickupWindowRelationRepository(): AcceptOptionsPickupWindowRelationRepositoryInterface
        {
            return $this->acceptOptionsPickupWindowRelationRepository;
        }

        /**
         * Order Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         */
        private $orderRepository;

        /**
         * Gets Order Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        protected function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->orderRepository;
        }

        /**
         * Search Criteria Builder property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         */
        private $searchCriteriaBuilder;

        /**
         * Gets Search Criteria Builder
         *
         * @access protected
         * @final
         *
         * @return \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected final function getSearchCriteriaBuilder(): SearchCriteriaBuilder
        {
            return $this->searchCriteriaBuilder;
        }
    }
?>