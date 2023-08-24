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
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class PickupWindowRelation
    implements ModelRelationProcessorInterface
    {
        protected const
            FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id',
            FIELD_PICKUP_WINDOW_ID = 'pickup_window_id';

        public function __construct(
            PickupWindowRepositoryInterface $pickupWindowRepository,
            AcceptOptionsPickupWindowRelationInterfaceFactory $acceptOptionsPickupWindowRelationFactory,
            AcceptOptionsPickupWindowRelationRepositoryInterface $acceptOptionsPickupWindowRelationRepository
        )
        {
            $this->_pickupWindowRepository = $pickupWindowRepository;
            $this->_acceptOptionsPickupWindowRelationFactory = $acceptOptionsPickupWindowRelationFactory;
            $this->_acceptOptionsPickupWindowRelationRepository = $acceptOptionsPickupWindowRelationRepository;
        }

        /**
         * {@inheritdoc}
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
                        try{
                            $persistedPickupWindow = $pickupWindowRepository->getBySkroutzId($pickupWindow->getSkroutzId());
                            $pickupWindow->setId($persistedPickupWindow->getId());
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
        private $_pickupWindowRepository;

        /**
         * Gets Pickup Window Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupWindowRepositoryInterface
         */
        protected function getPickupWindowRepository(): PickupWindowRepositoryInterface
        {
            return $this->_pickupWindowRepository;
        }

        /**
         * Accept Options Pickup Window Relation Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory $_acceptOptionsPickupWindowRelationFactory
         */
        private $_acceptOptionsPickupWindowRelationFactory;

        /**
         * Gets Accept Options Pickup Window Relation Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory
         */
        protected function getAcceptOptionsPickupWindowRelationFactory(): AcceptOptionsPickupWindowRelationInterfaceFactory
        {
            return $this->_acceptOptionsPickupWindowRelationFactory;
        }

        /**
         * Accept Options Pickup Window Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface $_acceptOptionsPickupWindowRelationRepository
         */
        private $_acceptOptionsPickupWindowRelationRepository;

        /**
         * Gets Accept Options Pickup Window Relation Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupWindowRelationRepositoryInterface
         */
        protected function getAcceptOptionsPickupWindowRelationRepository(): AcceptOptionsPickupWindowRelationRepositoryInterface
        {
            return $this->_acceptOptionsPickupWindowRelationRepository;
        }
    }
?>