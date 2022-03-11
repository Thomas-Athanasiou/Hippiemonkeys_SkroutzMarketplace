<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Order;

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\LineItemRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException;

    class LineItemRelation
    implements RelationInterface
    {
        /**
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\LineItemRepositoryInterface $lineItemRepository
         */
        public function __construct(
            LineItemRepositoryInterface $lineItemRepository
        )
        {
            $this->_lineItemRepository = $lineItemRepository;
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
            /** @var \Hippiemonkeys\SkroutzSmartCart\Api\Data\Order $object */
            $lineItemRepository = $this->getLineItemRepository();
            foreach($object->getLineItems() as $lineItem)
            {
                if(!$lineItem->getLocalId())
                {
                    try
                    {
                        $lineItem->setLocalId(
                            $lineItemRepository->getBySkroutzId( $lineItem->getSkroutzId() )->getLocalId()
                        );
                    }
                    catch(NoSuchEntityException $exception)
                    {
                        /** Line Item doesnt exist in the first place */
                    }
                }
                $lineItem->setOrder($object);
                $lineItemRepository->save($lineItem);
            }
        }

        /**
         * Line Item Repository property
         *
         * @var \Hippiemonkeys\SkroutzSmartCart\Api\LineItemRepositoryInterface
         */
        private $_lineItemRepository;

        /**
         * Gets Line Item Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\LineItemRepositoryInterface
         */
        protected function getLineItemRepository()
        {
            return $this->_lineItemRepository;
        }
    }
?>