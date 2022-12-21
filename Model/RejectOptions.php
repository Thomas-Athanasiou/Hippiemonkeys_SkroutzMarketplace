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
    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\AbstractResource,
        Magento\Framework\Data\Collection\AbstractDb,

        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\RejectOptions as ResourceModel;

    class RejectOptions
    extends AbstractModel
    implements RejectOptionsInterface
    {
        public const
            FIELD_ORDER                         = 'order',
            FIELD_LINE_ITEM_REJECTION_REASON    = 'line_item_rejection_reason',

            REJECT_OPTIONS_LINE_ITEM_REJECTION_RESON_RELATION_FIELD_REJECT_OPTIONS_ID = 'reject_options_id';

        public function __construct(
            Context $context,
            Registry $registry,

            RejectOptionslineItemRejectionReasonRelationRepositoryInterface $rejectOptionsLineItemRejectionReasonRelationRepository,
            LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository,
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
            $this->_rejectOptionsLineItemRejectionReasonRelationRepository  = $rejectOptionsLineItemRejectionReasonRelationRepository;
            $this->_lineItemRejectionReasonRepository                       = $lineItemRejectionReasonRepository;
            $this->_orderRepository                                         = $orderRepository;
        }
        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        /**
         * @inheritdoc
         */
        public function getLineItemRejectionReasons(): array
        {
            $lineItemRejectionReason = $this->getData(self::FIELD_LINE_ITEM_REJECTION_REASON);
            if (!$lineItemRejectionReason) {
                $lineItemRejectionReason = [];
                $rejectOptionsLineItemRejectionReasonRelations = $this->getRejectOptionsLineItemRejectionReasonRelationRepository()
                    ->getList(
                        $this->getSearchCriteriaBuilderFactory()
                            ->create()
                            ->addFilter(self::REJECT_OPTIONS_LINE_ITEM_REJECTION_RESON_RELATION_FIELD_REJECT_OPTIONS_ID, $this->getId())
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
         * @inheritdoc
         */
        public function setLineItemRejectionReasons(array $lineItemRejectionReason)
        {
            return $this->setData(self::FIELD_LINE_ITEM_REJECTION_REASON, $lineItemRejectionReason);
        }

        private $_rejectOptionsLineItemRejectionReasonRelationRepository;
        protected function getRejectOptionsLineItemRejectionReasonRelationRepository(): RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
        {
            return $this->_rejectOptionsLineItemRejectionReasonRelationRepository;
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

        private $_orderRepository;
        protected function getOrderRepository(): OrderRepositoryInterface
        {
            return $this->_orderRepository;
        }
    }
?>