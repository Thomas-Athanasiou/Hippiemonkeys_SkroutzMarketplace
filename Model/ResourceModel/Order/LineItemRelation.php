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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Order;

    use Hippiemonkeys\Core\Api\Data\ModelInterface,
        Hippiemonkeys\Core\Model\Spi\ModelRelationProcessorInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class LineItemRelation
    implements ModelRelationProcessorInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface $lineItemRepository
         */
        public function __construct(
            LineItemRepositoryInterface $lineItemRepository
        )
        {
            $this->_lineItemRepository = $lineItemRepository;
        }

        /**
         * {@inheritdoc}
         */
        public function processModelRelation(ModelInterface $model): void
        {
            /** @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $model */
            $lineItemRepository = $this->getLineItemRepository();
            if($model instanceof OrderInterface)
            {
                foreach($model->getLineItems() as $lineItem)
                {
                    if(!$lineItem->getId())
                    {
                        try
                        {
                            $lineItem->setId(
                                $lineItemRepository->getBySkroutzId($lineItem->getSkroutzId())->getId()
                            );
                        }
                        catch(NoSuchEntityException)
                        {
                            /** Line Item doesnt exist in the first place */
                        }
                    }
                    $lineItem->setOrder($model);
                    $lineItemRepository->save($lineItem);
                }
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