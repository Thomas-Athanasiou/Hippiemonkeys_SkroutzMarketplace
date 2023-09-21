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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\RejectOptions;

    use Magento\Framework\Model\AbstractModel as MagentoAbstractModel,
        Magento\Framework\Exception\NoSuchEntityException,
        Hippiemonkeys\Core\Api\Data\ModelInterface,
        Hippiemonkeys\Core\Model\Spi\ModelRelationProcessorInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface;

    class LineItemRejectionReasonRelation
    implements ModelRelationProcessorInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory $rejectOptionsLineItemRejectionReasonRelationFactory
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface $rejectOptionsLineItemRejectionReasonRelationRepository
         */
        public function __construct(
            LineItemRejectionReasonRepositoryInterface $lineItemRejectionReasonRepository,
            RejectOptionsLineItemRejectionReasonRelationInterfaceFactory $rejectOptionsLineItemRejectionReasonRelationFactory,
            RejectOptionsLineItemRejectionReasonRelationRepositoryInterface $rejectOptionsLineItemRejectionReasonRelationRepository
        )
        {
            $this->_lineItemRejectionReasonRepository = $lineItemRejectionReasonRepository;
            $this->_rejectOptionsLineItemRejectionReasonRelationFactory = $rejectOptionsLineItemRejectionReasonRelationFactory;
            $this->_rejectOptionsLineItemRejectionReasonRelationRepository = $rejectOptionsLineItemRejectionReasonRelationRepository;
        }

        /**
         * @inheritdoc
         */
        public function processModelRelation(ModelInterface $model): void
        {
            $lineItemRejectionReasonRepository = $this->getLineItemRejectionReasonRepository();
            $rejectOptionsLineItemRejectionReasonRelationFactory = $this->getRejectOptionsLineItemRejectionReasonRelationFactory();
            $rejectOptionsLineItemRejectionReasonRelationRepository = $this->getRejectOptionsLineItemRejectionReasonRelationRepository();
            if($model instanceof RejectOptionsInterface)
            {
                foreach($model->getLineItemRejectionReasons() as $lineItemRejectionReason)
                {
                    if($lineItemRejectionReason->getId() === null)
                    {
                        try{
                            $persistedLineItemRejectionReason = $lineItemRejectionReasonRepository->getBySkroutzId(
                                $lineItemRejectionReason->getSkroutzId()
                            );
                            $lineItemRejectionReason->setId(
                                $persistedLineItemRejectionReason->getId()
                            );
                        }
                        catch(NoSuchEntityException)
                        {
                            if($lineItemRejectionReason instanceof MagentoAbstractModel)
                            {
                                $lineItemRejectionReason->isObjectNew(true);
                            }
                        }
                    }
                    $lineItemRejectionReasonRepository->save($lineItemRejectionReason);

                    try
                    {
                        $rejectOptionsLineItemRejectionReasonRelationRepository->getByRejectOptionsAndLineItemRejectionReason($model, $lineItemRejectionReason);
                    }
                    catch(NoSuchEntityException)
                    {
                        $rejectOptionsLineItemRejectionReasonRelation = $rejectOptionsLineItemRejectionReasonRelationFactory->create();
                        $rejectOptionsLineItemRejectionReasonRelation->setRejectOptions($model);
                        $rejectOptionsLineItemRejectionReasonRelation->setLineItemRejectionReason($lineItemRejectionReason);
                        $rejectOptionsLineItemRejectionReasonRelationRepository->save($rejectOptionsLineItemRejectionReasonRelation);
                    }
                }
            }
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
         * Gets Line Item Rejection Reason Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface
         */
        protected function getLineItemRejectionReasonRepository(): LineItemRejectionReasonRepositoryInterface
        {
            return $this->_lineItemRejectionReasonRepository;
        }

        /**
         * Reject Options Line Item Rejection Reason Relation Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory $_rejectOptionsLineItemRejectionReasonRelationFactory
         */
        private $_rejectOptionsLineItemRejectionReasonRelationFactory;

        /**
         * Gets Reject Options Line Item Rejection Reason Relation Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterfaceFactory
         */
        protected function getRejectOptionsLineItemRejectionReasonRelationFactory(): RejectOptionsLineItemRejectionReasonRelationInterfaceFactory
        {
            return $this->_rejectOptionsLineItemRejectionReasonRelationFactory;
        }

        /**
         * Reject Options Line Item Rejection Reason Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsLineItemRejectionReasonRelationRepositoryInterfaceInterface $_lineItemRejectionReasonRepository
         */
        private $_rejectOptionsLineItemRejectionReasonRelationRepository;

        /**
         * Gets Reject Options Line Item Rejection Reason Relation Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
         */
        protected function getRejectOptionsLineItemRejectionReasonRelationRepository(): RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
        {
            return $this->_rejectOptionsLineItemRejectionReasonRelationRepository;
        }
    }
?>