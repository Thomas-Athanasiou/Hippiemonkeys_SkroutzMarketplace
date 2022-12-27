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

            REJECT_OPTIONS_LINE_ITEM_REJECTION_RESON_RELATION_FIELD_REJECT_OPTIONS_ID = 'reject_options_id';

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

            $this->_rejectOptionsLineItemRejectionReasonRelationRepository  = $rejectOptionsLineItemRejectionReasonRelationRepository;
            $this->_lineItemRejectionReasonRepository = $lineItemRejectionReasonRepository;
            $this->_orderRepository = $orderRepository;
            $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        }

        /**
         * {@inheritdoc}
         */
        public function getLineItemRejectionReasons(): array
        {
            $lineItemRejectionReason = $this->getData(static::FIELD_LINE_ITEM_REJECTION_REASON);
            if(!$lineItemRejectionReason === null)
            {
                $lineItemRejectionReason = [];
                $rejectOptionsLineItemRejectionReasonRelations = $this->getRejectOptionsLineItemRejectionReasonRelationRepository()
                    ->getList(
                        $this->getSearchCriteriaBuilder()
                            ->addFilter(static::REJECT_OPTIONS_LINE_ITEM_REJECTION_RESON_RELATION_FIELD_REJECT_OPTIONS_ID, $this->getId())
                            ->create()
                    )
                    ->getItems();

                foreach($rejectOptionsLineItemRejectionReasonRelations as $rejectOptionsLineItemRejectionReasonRelation)
                {
                    $lineItemRejectionReason[] = $rejectOptionsLineItemRejectionReasonRelation->getLineItemRejectionReasons();
                }

                $this->setLineItemRejectionReasons($lineItemRejectionReason);
            }
            return $lineItemRejectionReason;
        }

        /**
         * {@inheritdoc}
         */
        public function setLineItemRejectionReasons(array $lineItemRejectionReason)
        {
            return $this->setData(static::FIELD_LINE_ITEM_REJECTION_REASON, $lineItemRejectionReason);
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
                    $this->getData(ResourceInterface::FIELD_ORDER_ID)
                );
                $this->setData(ResourceInterface::FIELD_ORDER_ID, $order);
            }
            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function setOrder(OrderInterface $order)
        {
            $this->setData(ResourceInterface::FIELD_ORDER_ID, $order->getId());
            return $this->setData(static::FIELD_ORDER, $order);
        }

        /**
         * Reject Options Line Item Rejection Reason Relation Repository property
         *
         * @access private
         *
         * @var Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
         */
        private $_rejectOptionsLineItemRejectionReasonRelationRepository;


        /**
         * Gets Reject Options Line Item Rejection Reason Relation Repository property
         *
         * @access protected
         *
         * @return Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
         */
        protected function getRejectOptionsLineItemRejectionReasonRelationRepository(): RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
        {
            return $this->_rejectOptionsLineItemRejectionReasonRelationRepository;
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
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        protected function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->_orderRepository;
        }
    }
?>