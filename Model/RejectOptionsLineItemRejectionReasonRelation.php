<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Framework\Registry,
        Magento\Framework\Model\Context,
        Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\AbstractResource,
        Magento\Framework\Data\Collection\AbstractDb,

        Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\RejectOptionsLineItemRejectionReasonRelation as ResourceModel;

    class RejectOptionsLineItemRejectionReasonRelation
    extends AbstractModel
    implements RejectOptionsLineItemRejectionReasonRelationInterface
    {
        protected const
            FIELD_REJECT_OPTIONS                    = 'reject_options',
            FIELD_LINE_ITEM_REJECTION_REASON        = 'line_item_rejection_reason';

        protected function _construct()
        {
            $this->_init(ResourceModel::class);
        }

        public function __construct(
            Context $context,
            Registry $registry,

            RejectOptionsRepositoryInterface $rejectOptionsRepository,
            LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository,

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
            $this->_rejectOptionsRepository             = $rejectOptionsRepository;
            $this->_lineItemRejectionReasonRepository   = $lineItemRejectionReasonRepository;
        }

        /**
         * @inheritdoc
         */
        public function getRejectOptions(): RejectOptionsInterface
        {
            $rejectOptions = $this->getData(self::FIELD_REJECT_OPTIONS);
            if(!$rejectOptions)
            {
                $rejectOptionsId    = $this->getData(ResourceModel::FIELD_REJECT_OPTIONS_ID);
                $rejectOptions      = $this->getRejectOptionsRepository()->getById($rejectOptionsId);
                $this->setRejectOptions($rejectOptions);
            }
            return $rejectOptions;
        }

        /**
         * @inheritdoc
         */
        public function setRejectOptions(RejectOptionsInterface $rejectOptions)
        {
            $this->setData(ResourceModel::FIELD_REJECT_OPTIONS_ID, $rejectOptions->getId());
            return $this->setData(self::FIELD_REJECT_OPTIONS, $rejectOptions);
        }

        /**
         * @inheritdoc
         */
        public function getLineItemRejectionReason(): LineItemRejectionReasonInterface
        {
            $lineItemRejectionReason = $this->getData(self::FIELD_LINE_ITEM_REJECTION_REASON);
            if(!$rejectOptions)
            {
                $lineItemRejectionReasonId   = $this->getData(ResourceModel::FIELD_LINE_ITEM_REJECTION_REASON_ID);
                $lineItemRejectionReason     = $this->getLineItemRejectionReasonRepository()->getByLocalId($lineItemRejectionReasonId);
                $this->setLineItemRejectionReason($lineItemRejectionReason);
            }
            return $lineItemRejectionReason;
        }

        /**
         * @inheritdoc
         */
        public function setLineItemRejectionReason(LineItemRejectionReasonInterface $lineItemRejectionReason)
        {
            $this->setData(ResourceModel::FIELD_LINE_ITEM_REJECTION_REASON_ID, $lineItemRejectionReason->getLocalId());
            return $this->setData(self::FIELD_LINE_ITEM_REJECTION_REASON, $lineItemRejectionReason);
        }

        private $_rejectOptionsRepository;
        protected function getRejectOptionsRepository(): RejectOptionsRepositoryInterface
        {
            return $this->_rejectOptionsRepository;
        }

        private $_lineItemRejectionReasonRepository;
        protected function getLineItemRejectionReasonRepository(): LineItemRejectionReasonRepositoryInterface
        {
            return $this->_lineItemRejectionReasonRepository;
        }
    }
?>