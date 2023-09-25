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

use Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface;
use Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface;
use Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Magento\Framework\Api\SearchCriteriaBuilder,
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface as ResourceInterface;

    class RejectOptions
    extends AbstractModel
    implements RejectOptionsInterface
    {
        public const
            FIELD_ORDER = 'order',
            FIELD_LINE_ITEM_REJECTION_REASON = 'line_item_rejection_reason',

            REJECT_OPTIONS_LINE_ITEM_REJECTION_REASON_RELATION_FIELD_REJECT_OPTIONS_ID = 'reject_options_id';

        public function __construct(
            Context $context,
            Registry $registry,
            RejectOptionslineItemRejectionReasonRelationRepositoryInterface $rejectOptionsLineItemRejectionReasonRelationRepository,
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
            $lineItemRejectionReasons = $this->getData(static::FIELD_LINE_ITEM_REJECTION_REASON);
            if(!$lineItemRejectionReasons === null)
            {
                $lineItemRejectionReasons = array_map(
                    function(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): LineItemRejectionReasonInterface
                    {
                        return $rejectOptionsLineItemRejectionReasonRelation->getLineItemRejectionReason();
                    },
                    $this->getRejectOptionsLineItemRejectionReasonRelationRepository()
                        ->getList(
                            $this->getSearchCriteriaBuilder()
                                ->addFilter(static::REJECT_OPTIONS_LINE_ITEM_REJECTION_REASON_RELATION_FIELD_REJECT_OPTIONS_ID, $this->getId())
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
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
         */
        protected function getRejectOptionsLineItemRejectionReasonRelationRepository(): RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
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
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        protected function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->orderRepository;
        }
    }
?>