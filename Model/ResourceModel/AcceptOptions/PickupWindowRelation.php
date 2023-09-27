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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\AcceptOptions;

    use Magento\Framework\Model\AbstractModel as MagentoAbstractModel,
        Hippiemonkeys\Core\Api\Data\ModelInterface,
        Hippiemonkeys\Core\Model\Spi\ModelRelationProcessorInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupWindowRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface,
        Magento\Framework\Exception\NoSuchEntityException;

    class PickupWindowRelation
    implements ModelRelationProcessorInterface
    {
        public function __construct(
            PickupWindowRepositoryInterface $pickupWindowRepository,
            AcceptOptionsPickupWindowRelationInterfaceFactory $acceptOptionsPickupWindowRelationFactory,
            AcceptOptionsPickupWindowRelationRepositoryInterface $acceptOptionsPickupWindowRelationRepository
        )
        {
            $this->pickupWindowRepository = $pickupWindowRepository;
            $this->acceptOptionsPickupWindowRelationFactory = $acceptOptionsPickupWindowRelationFactory;
            $this->acceptOptionsPickupWindowRelationRepository = $acceptOptionsPickupWindowRelationRepository;
        }

        /**
         * @inheritdoc
         */
        public function processModelRelation(ModelInterface $model): void
        {
            $pickupWindowRepository = $this->getPickupWindowRepository();
            $acceptOptionsPickupWindowRelationFactory = $this->getAcceptOptionsPickupWindowRelationFactory();
            $acceptOptionsPickupWindowRelationRepository = $this->getAcceptOptionsPickupWindowRelationRepository();
            if($model instanceof AcceptOptionsInterface)
            {
                foreach($model->getPickupWindow() as $pickupWindow)
                {
                    if($pickupWindow->getId() === null)
                    {
                        try
                        {
                            $pickupWindow->setId($pickupWindowRepository->getBySkroutzId($pickupWindow->getSkroutzId())->getId());
                        }
                        catch(NoSuchEntityException)
                        {
                            if ($pickupWindow instanceof MagentoAbstractModel)
                            {
                                $pickupWindow->isObjectNew(true);
                            }
                        }
                    }
                    $pickupWindowRepository->save($pickupWindow);

                    try
                    {
                        $acceptOptionsPickupWindowRelation = $acceptOptionsPickupWindowRelationRepository->getByAcceptOptionsAndPickupWindow($model, $pickupWindow);
                    }
                    catch(NoSuchEntityException)
                    {
                        $acceptOptionsPickupWindowRelation = $acceptOptionsPickupWindowRelationFactory->create();
                        $acceptOptionsPickupWindowRelation->setAcceptOptions($model);
                        $acceptOptionsPickupWindowRelation->setPickupWindow($pickupWindow);
                        $acceptOptionsPickupWindowRelationRepository->save($acceptOptionsPickupWindowRelation);
                    }
                }
            }
        }

        /**
         * Pickup Window Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\PickupWindowRepositoryInterface
         */
        private $pickupWindowRepository;

        /**
         * Gets Pickup Window Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupWindowRepositoryInterface
         */
        protected final function getPickupWindowRepository(): PickupWindowRepositoryInterface
        {
            return $this->pickupWindowRepository;
        }

        /**
         * Accept Options Pickup Window Relation Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory $acceptOptionsPickupWindowRelationFactory
         */
        private $acceptOptionsPickupWindowRelationFactory;

        /**
         * Gets Accept Options Pickup Window Relation Factory
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory
         */
        protected final function getAcceptOptionsPickupWindowRelationFactory(): AcceptOptionsPickupWindowRelationInterfaceFactory
        {
            return $this->acceptOptionsPickupWindowRelationFactory;
        }

        /**
         * Accept Options Pickup Window Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface $acceptOptionsPickupWindowRelationRepository
         */
        private $acceptOptionsPickupWindowRelationRepository;

        /**
         * Gets Accept Options Pickup Window Relation Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface
         */
        protected final function getAcceptOptionsPickupWindowRelationRepository(): AcceptOptionsPickupWindowRelationRepositoryInterface
        {
            return $this->acceptOptionsPickupWindowRelationRepository;
        }
    }
?>