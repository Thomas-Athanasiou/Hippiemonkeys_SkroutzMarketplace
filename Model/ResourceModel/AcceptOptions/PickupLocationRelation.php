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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\AcceptOptions;

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class PickupLocationRelation
    implements RelationInterface
    {
        protected const
            FIELD_ACCEPT_OPTIONS_ID     = 'accept_options_id',
            FIELD_PICKUP_LOCATION_ID    = 'pickup_location_id';

        public function __construct(
            PickupLocationRepositoryInterface $pickupLocationRepository,
            AcceptOptionsPickupLocationRelationInterfaceFactory $acceptOptionsPickupLocationRelationFactory,
            AcceptOptionsPickupLocationRelationRepositoryInterface $acceptOptionsPickupLocationRelationRepository
        )
        {
            $this->_pickupLocationRepository                        = $pickupLocationRepository;
            $this->_acceptOptionsPickupLocationRelationFactory      = $acceptOptionsPickupLocationRelationFactory;
            $this->_acceptOptionsPickupLocationRelationRepository   = $acceptOptionsPickupLocationRelationRepository;
        }

        /**
         * Saves relations for Pickup Location
         *
         * @param \Magento\Framework\Model\AbstractModel $object
         * @return void
         * @throws \Exception
         */
        public function processRelation(AbstractModel $object)
        {
            $pickupLocationRepository                       = $this->getPickupLocationRepository();
            $acceptOptionsPickupLocationRelationFactory     = $this->getAcceptOptionsPickupLocationRelationFactory();
            $acceptOptionsPickupLocationRelationRepository  = $this->getAcceptOptionsPickupLocationRelationRepository();
            foreach($object->getPickupLocation() as $pickupLocation)
            {
                if(!$pickupLocation->getLocalId())
                {
                    try{
                        $persistedPickupLocation = $pickupLocationRepository->getBySkroutzId(
                            $pickupLocation->getSkroutzId()
                        );
                        $pickupLocation->setLocalId(
                            $persistedPickupLocation->getLocalId()
                        );
                    }
                    catch(NoSuchEntityException $exception)
                    {
                        $pickupLocation->isObjectNew(true);
                    }
                }
                $pickupLocationRepository->save($pickupLocation);

                try
                {
                    $acceptOptionsPickupLocationRelation = $acceptOptionsPickupLocationRelationRepository->getByAcceptOptionsAndPickupLocation($object, $pickupLocation);
                }
                catch(NoSuchEntityException $exception)
                {
                    $acceptOptionsPickupLocationRelation = $acceptOptionsPickupLocationRelationFactory->create();
                    $acceptOptionsPickupLocationRelation->setAcceptOptions($object);
                    $acceptOptionsPickupLocationRelation->setPickupLocation($pickupLocation);
                    $acceptOptionsPickupLocationRelationRepository->save($acceptOptionsPickupLocationRelation);
                }
            }
        }

        /**
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface
         */
        private $_pickupLocationRepository;

        /**
         * Gets Pickup Location Repository
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface
         */
        protected function getPickupLocationRepository(): PickupLocationRepositoryInterface
        {
            return $this->_pickupLocationRepository;
        }

        private $_acceptOptionsPickupLocationRelationFactory;
        protected function getAcceptOptionsPickupLocationRelationFactory(): AcceptOptionsPickupLocationRelationInterfaceFactory
        {
            return $this->_acceptOptionsPickupLocationRelationFactory;
        }

        private $_acceptOptionsPickupLocationRelationRepository;
        protected function getAcceptOptionsPickupLocationRelationRepository(): AcceptOptionsPickupLocationRelationRepositoryInterface
        {
            return $this->_acceptOptionsPickupLocationRelationRepository;
        }
    }
?>