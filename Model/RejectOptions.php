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
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsLineItemRejectionReasonRelationResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface as ResourceInterface;

    class RejectOptions
    extends AbstractModel
    implements RejectOptionsInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface $rejectOptionsLineItemRejectionReasonRelationRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
         * @param array $data
         */
        public function __construct(
            Context $context,
            Registry $registry,
            RejectOptionsLineItemRejectionReasonRelationRepositoryInterface $rejectOptionsLineItemRejectionReasonRelationRepository,
            LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository,
            OrderRepositoryInterface $orderRepository,
            SearchCriteriaBuilder $searchCriteriaBuilder,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

            $this->rejectOptionsLineItemRejectionReasonRelationRepository  = $rejectOptionsLineItemRejectionReasonRelationRepository;
            $this->lineItemRejectionReasonRepository = $lineItemRejectionReasonRepository;
            $this->orderRepository = $orderRepository;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;

            $this->lineItemRejectionReasons = null;
            $this->order = null;
        }

        /**
         * Line Item Rejection Reasons
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface[]|null $lineItemRejectionReasons
         */
        private $lineItemRejectionReasons;

        /**
         * @inheritdoc
         */
        public function getLineItemRejectionReasons(): array
        {
            $lineItemRejectionReasons = $this->lineItemRejectionReasons;

            if($lineItemRejectionReasons === null)
            {
                $lineItemRejectionReasons = array_map(
                    function(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): LineItemRejectionReasonInterface
                    {
                        return $rejectOptionsLineItemRejectionReasonRelation->getLineItemRejectionReason();
                    },
                    $this->getRejectOptionsLineItemRejectionReasonRelationRepository()
                        ->getList(
                            $this->getSearchCriteriaBuilder()
                                ->addFilter(RejectOptionsLineItemRejectionReasonRelationResourceInterface::FIELD_REJECT_OPTIONS_ID, $this->getId())
                                ->create()
                        )
                        ->getItems()
                );

                $this->lineItemRejectionReasons = $lineItemRejectionReasons;
            }

            return $lineItemRejectionReasons;
        }

        /**
         * @inheritdoc
         */
        public function setLineItemRejectionReasons(array $lineItemRejectionReason): self
        {
            $this->lineItemRejectionReason = $lineItemRejectionReason;
            return $this;
        }

        /**
         * Order property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
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
                $order = $this->getOrderRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_ORDER_ID)
                );
                $this->order = $order;
            }

            return $order;
        }

        /**
         * @inheritdoc
         */
        public function setOrder(OrderInterface $order): RejectOptions
        {
            $this->order = $order;
            return $this->setData(ResourceInterface::FIELD_ORDER_ID, $order->getId());
        }

        /**
         * Reject Options Line Item Rejection Reason Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
         */
        private $rejectOptionsLineItemRejectionReasonRelationRepository;


        /**
         * Gets Reject Options Line Item Rejection Reason Relation Repository property
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
         */
        protected final function getRejectOptionsLineItemRejectionReasonRelationRepository(): RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
        {
            return $this->rejectOptionsLineItemRejectionReasonRelationRepository;
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