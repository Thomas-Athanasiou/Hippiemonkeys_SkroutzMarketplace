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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsResourceInterface as ResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupWindowRelationResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface;

    class AcceptOptions
    extends AbstractModel
    implements AcceptOptionsInterface
    {
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
            $this->pickupLocation = null;
            $this->pickupWindow = null;
        }

        /**
         * @inheritdoc
         */
        public function getNumberOfParcels() : array
        {
            return explode(';', $this->getData(ResourceInterface::FIELD_NUMBER_OF_PARCELS));
        }

        /**
         * @inheritdoc
         */
        public function setNumberOfParcels(array $numberOfParcels): self
        {
            return $this->setData(ResourceInterface::FIELD_NUMBER_OF_PARCELS, implode(';', $numberOfParcels));
        }

        /**
         * Order Property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface|null $order
         */
        private $order;

        /**
         * @inheritdoc
         */
        public function getOrder(): OrderInterface
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
         */
        public function setOrder(OrderInterface $order): self
        {
            $this->order = $order;
            return $this->setData(ResourceInterface::FIELD_ORDER_ID, $order->getId());
        }

        /**
         * Pickup Location property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface[] $pickupLocation
         */
        private $pickupLocation;

        /**
         * @inheritdoc
         */
        public function getPickupLocation(): array
        {
            $pickupLocation = $this->pickupLocation;
            if ($pickupLocation === null)
            {
                $pickupLocation = array_map(
                    function(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation): PickupLocationInterface
                    {
                        return $acceptOptionsPickupLocationRelation->getPickupLocation();
                    },
                    $this->getAcceptOptionsPickupLocationRelationRepository()
                        ->getList(
                            $this->getSearchCriteriaBuilder()
                                ->addFilter(AcceptOptionsPickupLocationRelationResourceInterface::FIELD_ID, $this->getId())
                                ->create()
                        )
                        ->getItems()
                );
                $this->pickupLocation = $pickupLocation;
            }
            return $pickupLocation;
        }

        /**
         * @inheritdoc
         */
        public function setPickupLocation(array $pickupLocation): self
        {
            $this->pickupLocation = $pickupLocation;
            return $this;
        }

        /**
         * Pickup Window property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface[] $pickupWindow
         */
        private $pickupWindow;

        /**
         * @inheritdoc
         */
        public function getPickupWindow(): array
        {
            $pickupWindow = $this->pickupWindow;
            if ($pickupWindow === null)
            {
                $pickupWindow = array_map(
                    function(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation): PickupWindowInterface
                    {
                        return $acceptOptionsPickupWindowRelation->getPickupWindow();
                    },
                    $this->getAcceptOptionsPickupWindowRelationRepository()
                        ->getList(
                            $this->getSearchCriteriaBuilder()
                                ->addFilter(AcceptOptionsPickupWindowRelationResourceInterface::FIELD_ID, $this->getId())
                                ->create()
                        )
                        ->getItems()
                );
                $this->pickupWindow = $pickupWindow;
            }
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function setPickupWindow(array $pickupWindow): self
        {
            $this->pickupWindow = $pickupWindow;
            return $this;
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
        protected final function getOrderRepository(): OrderRepositoryInterface
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