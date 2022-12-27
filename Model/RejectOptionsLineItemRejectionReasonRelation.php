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
        Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsLineItemRejectionReasonRelationResourceInterface as ResourceInterface;

    class RejectOptionsLineItemRejectionReasonRelation
    extends AbstractModel
    implements RejectOptionsLineItemRejectionReasonRelationInterface
    {
        protected const
            FIELD_REJECT_OPTIONS = 'reject_options',
            FIELD_LINE_ITEM_REJECTION_REASON = 'line_item_rejection_reason';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Magento\Framework\Model\Context $context
         * @param \Magento\Framework\Registry $registry
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface $rejectOptionsRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository
         */
        public function __construct(
            Context $context,
            Registry $registry,
            RejectOptionsRepositoryInterface $rejectOptionsRepository,
            LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository,
            array $data = []
        )
        {
            parent::__construct($context, $registry, $data);

            $this->_rejectOptionsRepository = $rejectOptionsRepository;
            $this->_lineItemRejectionReasonRepository = $lineItemRejectionReasonRepository;
        }

        /**
         * {@inheritdoc}
         */
        public function getRejectOptions(): RejectOptionsInterface
        {
            $rejectOptions = $this->getData(self::FIELD_REJECT_OPTIONS);
            if($rejectOptions === null)
            {
                $rejectOptions = $this->getRejectOptionsRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_REJECT_OPTIONS_ID)
                );
                $this->setRejectOptions($rejectOptions);
            }
            return $rejectOptions;
        }

        /**
         * {@inheritdoc}
         */
        public function setRejectOptions(RejectOptionsInterface $rejectOptions)
        {
            $this->setData(ResourceInterface::FIELD_REJECT_OPTIONS_ID, $rejectOptions->getId());
            return $this->setData(self::FIELD_REJECT_OPTIONS, $rejectOptions);
        }

        /**
         * {@inheritdoc}
         */
        public function getLineItemRejectionReason(): LineItemRejectionReasonInterface
        {
            $lineItemRejectionReason = $this->getData(self::FIELD_LINE_ITEM_REJECTION_REASON);
            if($lineItemRejectionReason === null)
            {
                $lineItemRejectionReason = $this->getLineItemRejectionReasonRepository()->getById(
                    $this->getData(ResourceInterface::FIELD_LINE_ITEM_REJECTION_REASON_ID)
                );
                $this->setData(self::FIELD_LINE_ITEM_REJECTION_REASON, $lineItemRejectionReason);
            }
            return $lineItemRejectionReason;
        }

        /**
         * {@inheritdoc}
         */
        public function setLineItemRejectionReason(LineItemRejectionReasonInterface $lineItemRejectionReason)
        {
            $this->setData(ResourceInterface::FIELD_LINE_ITEM_REJECTION_REASON_ID, $lineItemRejectionReason->getId());
            return $this->setData(self::FIELD_LINE_ITEM_REJECTION_REASON, $lineItemRejectionReason);
        }

        /**
         *  Reject Options Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface $_rejectOptionsRepository
         */
        private $_rejectOptionsRepository;

        /**
         *  Gets Reject Options Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface
         */
        protected function getRejectOptionsRepository(): RejectOptionsRepositoryInterface
        {
            return $this->_rejectOptionsRepository;
        }

        /**
         * Line Item Rejection Reason Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface $_lineItemRejectionReasonRepository
         */
        private $_lineItemRejectionReasonRepository;

        /**
         *  Gets Line Item Rejection Reason Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface
         */
        protected function getLineItemRejectionReasonRepository(): LineItemRejectionReasonRepositoryInterface
        {
            return $this->_lineItemRejectionReasonRepository;
        }
    }
?>