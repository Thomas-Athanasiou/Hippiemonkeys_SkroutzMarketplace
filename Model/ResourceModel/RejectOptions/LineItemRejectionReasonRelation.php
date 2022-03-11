<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\RejectOptions;

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException;

    class LineItemRejectionReasonRelation
    implements RelationInterface
    {
        protected const
            FIELD_REJECT_OPTIONS_ID = 'reject_options_id',
            FIELD_PICKUP_WINDOW_ID  = 'line_item_rejection_reason_id';

        /**
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory $rejectOptionsLineItemRejectionReasonRelationFactory
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface $rejectOptionsLineItemRejectionReasonRelationRepository
         *
         */
        public function __construct(
            LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository,
            RejectOptionsLineItemRejectionReasonRelationInterfaceFactory $rejectOptionsLineItemRejectionReasonRelationFactory,
            RejectOptionsLineItemRejectionReasonRelationRepositoryInterface $rejectOptionsLineItemRejectionReasonRelationRepository
        )
        {
            $this->_lineItemRejectionReasonRepository                       = $lineItemRejectionReasonRepository;
            $this->_rejectOptionsLineItemRejectionReasonRelationFactory     = $rejectOptionsLineItemRejectionReasonRelationFactory;
            $this->_rejectOptionsLineItemRejectionReasonRelationRepository  = $rejectOptionsLineItemRejectionReasonRelationRepository;
        }

        /**
         * Save relations for Line Item
         *
         * @param \Magento\Framework\Model\AbstractModel $object
         * @return void
         * @throws \Exception
         */
        public function processRelation(AbstractModel $object)
        {
            $lineItemRejectionReasonRepository                       = $this->getLineItemRejectionReasonRepository();
            $rejectOptionsLineItemRejectionReasonRelationFactory     = $this->getRejectOptionsLineItemRejectionReasonRelationFactory();
            $rejectOptionsLineItemRejectionReasonRelationRepository  = $this->getRejectOptionsLineItemRejectionReasonRelationRepository();
            foreach($object->getLineItemRejectionReason() as $lineItemRejectionReason)
            {
                if(!$lineItemRejectionReason->getLocalId())
                {
                    try{
                        $persistedLineItemRejectionReason = $lineItemRejectionReasonRepository->getBySkroutzId(
                            $lineItemRejectionReason->getSkroutzId()
                        );
                        $lineItemRejectionReason->setLocalId(
                            $persistedLineItemRejectionReason->getLocalId()
                        );
                    }
                    catch(NoSuchEntityException $exception)
                    {
                        $persistedLineItemRejectionReason->isObjectNew(true);
                    }
                }
                $lineItemRejectionReasonRepository->save($lineItemRejectionReason);

                try
                {
                    $rejectOptionsLineItemRejectionReasonRelationRepository->getByRejectOptionsAndLineItemRejectionReason($object, $lineItemRejectionReason);
                }
                catch(NoSuchEntityException $exception)
                {
                    $rejectOptionsLineItemRejectionReasonRelation = $rejectOptionsLineItemRejectionReasonRelationFactory->create();
                    $rejectOptionsLineItemRejectionReasonRelation->setRejectOptions($object);
                    $rejectOptionsLineItemRejectionReasonRelation->setLineItemRejectionReason($lineItemRejectionReason);
                    $rejectOptionsLineItemRejectionReasonRelationRepository->save($rejectOptionsLineItemRejectionReasonRelation);
                }
            }
        }

        private $_lineItemRejectionReasonRepository;
        protected function getLineItemRejectionReasonRepository(): LineItemRejectionReasonRepositoryInterface
        {
            return $this->_lineItemRejectionReasonRepository;
        }

        private $_rejectOptionsLineItemRejectionReasonRelationFactory;
        protected function getRejectOptionsLineItemRejectionReasonRelationFactory(): RejectOptionsLineItemRejectionReasonRelationInterfaceFactory
        {
            return $this->_rejectOptionsLineItemRejectionReasonRelationFactory;
        }

        private $_rejectOptionsLineItemRejectionReasonRelationRepository;
        protected function getRejectOptionsLineItemRejectionReasonRelationRepository(): RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
        {
            return $this->_rejectOptionsLineItemRejectionReasonRelationRepository;
        }
    }
?>