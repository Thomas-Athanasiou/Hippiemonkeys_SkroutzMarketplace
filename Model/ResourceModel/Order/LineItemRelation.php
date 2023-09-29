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
        Hippiemonkeys\SkroutzMarketplace\Api\SizeRepositoryInterface,
        Magento\Framework\Exception\NoSuchEntityException;

    class LineItemRelation
    implements ModelRelationProcessorInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface $lineItemRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\SizeRepositoryInterface $sizeRepository
         */
        public function __construct(
            LineItemRepositoryInterface $lineItemRepository,
            SizeRepositoryInterface $sizeRepository
        )
        {
            $this->lineItemRepository = $lineItemRepository;
            $this->sizeRepository = $sizeRepository;
        }

        /**
         * @inheritdoc
         */
        public function processModelRelation(ModelInterface $model): void
        {
            /** @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $model */
            if($model instanceof OrderInterface)
            {
                $lineItemRepository = $this->getLineItemRepository();
                $sizeRepository = $this->getSizeRepository();
                foreach($model->getLineItems() as $lineItem)
                {
                    $size = $lineItem->getSize();
                    if($lineItem->getId() === null)
                    {
                        try
                        {
                            $persistentLineItem = $lineItemRepository->getBySkroutzId($lineItem->getSkroutzId());
                            $lineItem->setId($persistentLineItem->getId());
                            $persistentSize = $persistentLineItem->getSize();
                            if($size === null)
                            {
                                $size = $persistentLineItem->getSize();
                            }
                            else if($persistentSize !== null)
                            {
                                $size->setId($persistentSize->getId());
                            }
                        }
                        catch(NoSuchEntityException)
                        {
                            /** Line Item doesn't exist in the first place */
                        }
                    }

                    if($size !== null)
                    {
                        $sizeRepository->save($size);
                        $lineItem->setSize($size);
                    }

                    $lineItem->setOrder($model);
                    $lineItemRepository->save($lineItem);
                }
            }
        }

        /**
         * Line Item Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface $lineItemRepository
         */
        private $lineItemRepository;

        /**
         * Gets Line Item Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\LineItemRepositoryInterface
         */
        protected final function getLineItemRepository(): LineItemRepositoryInterface
        {
            return $this->lineItemRepository;
        }

        /**
         * Size Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\SizeRepositoryInterface $sizeRepository
         */
        private $sizeRepository;

        /**
         * Gets Size Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\SizeRepositoryInterface
         */
        protected final function getSizeRepository(): SizeRepositoryInterface
        {
            return $this->sizeRepository;
        }
    }
?>