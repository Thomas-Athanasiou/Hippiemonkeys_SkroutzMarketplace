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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Order;

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class LineItemRelation
    implements RelationInterface
    {
        /**
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface $lineItemRepository
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
            /** @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\Order $object */
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface
         */
        private $_lineItemRepository;

        /**
         * Gets Line Item Repository
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface
         */
        protected function getLineItemRepository()
        {
            return $this->_lineItemRepository;
        }
    }
?>