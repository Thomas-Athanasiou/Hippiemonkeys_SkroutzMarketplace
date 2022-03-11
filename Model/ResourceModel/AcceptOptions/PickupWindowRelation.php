<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptions;

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\PickupWindowRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsPickupWindowRelationRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException;

    class PickupWindowRelation
    implements RelationInterface
    {
        protected const
            FIELD_ACCEPT_OPTIONS_ID     = 'accept_options_id',
            FIELD_PICKUP_LOCATION_ID    = 'pickup_location_id';

        public function __construct(
            PickupWindowRepositoryInterface $pickupWindowRepository,
            AcceptOptionsPickupWindowRelationInterfaceFactory $acceptOptionsPickupWindowRelationFactory,
            AcceptOptionsPickupWindowRelationRepositoryInterface $acceptOptionsPickupWindowRelationRepository
        )
        {
            $this->_pickupWindowRepository                      = $pickupWindowRepository;
            $this->_acceptOptionsPickupWindowRelationFactory    = $acceptOptionsPickupWindowRelationFactory;
            $this->_acceptOptionsPickupWindowRelationRepository = $acceptOptionsPickupWindowRelationRepository;
        }

        /**
         * Saves relations for Pickup Window
         *
         * @param \Magento\Framework\Model\AbstractModel $object
         * @return void
         * @throws \Exception
         */
        public function processRelation(AbstractModel $object)
        {
            $pickupWindowRepository                         = $this->getPickupWindowRepository();
            $acceptOptionsPickupWindowRelationFactory       = $this->getAcceptOptionsPickupWindowRelationFactory();
            $acceptOptionsPickupWindowRelationRepository    = $this->getAcceptOptionsPickupWindowRelationRepository();
            foreach($object->getPickupWindow() as $pickupWindow)
            {
                if(!$pickupWindow->getLocalId())
                {
                    try{
                        $persistedPickupWindow = $pickupWindowRepository->getBySkroutzId(
                            $pickupWindow->getSkroutzId()
                        );
                        $pickupWindow->setLocalId(
                            $persistedPickupWindow->getLocalId()
                        );
                    }
                    catch(NoSuchEntityException $exception)
                    {
                        $pickupWindow->isObjectNew(true);
                    }
                }
                $pickupWindowRepository->save($pickupWindow);

                try
                {
                    $acceptOptionsPickupWindowRelation = $acceptOptionsPickupWindowRelationRepository->getByAcceptOptionsAndPickupWindow($object, $pickupWindow);
                }
                catch(NoSuchEntityException $exception)
                {
                    $acceptOptionsPickupWindowRelation = $acceptOptionsPickupWindowRelationFactory->create();
                    $acceptOptionsPickupWindowRelation->setAcceptOptions($object);
                    $acceptOptionsPickupWindowRelation->setPickupWindow($pickupWindow);
                    $acceptOptionsPickupWindowRelationRepository->save($acceptOptionsPickupWindowRelation);
                }
            }
        }

        private $_pickupWindowRepository;
        protected function getPickupWindowRepository(): PickupWindowRepositoryInterface
        {
            return $this->_pickupWindowRepository;
        }

        private $_acceptOptionsPickupWindowRelationFactory;
        protected function getAcceptOptionsPickupWindowRelationFactory(): AcceptOptionsPickupWindowRelationInterfaceFactory
        {
            return $this->_acceptOptionsPickupWindowRelationFactory;
        }

        private $_acceptOptionsPickupWindowRelationRepository;
        protected function getAcceptOptionsPickupWindowRelationRepository(): AcceptOptionsPickupWindowRelationRepositoryInterface
        {
            return $this->_acceptOptionsPickupWindowRelationRepository;
        }
    }
?>