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

    use Magento\Framework\Model\AbstractModel as MagentoAbstractModel,
        Hippiemonkeys\Core\Api\Data\ModelInterface,
        Hippiemonkeys\Core\Model\Spi\ModelRelationProcessorInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class PickupLocationRelation
    implements ModelRelationProcessorInterface
    {
        protected const
            FIELD_ACCEPT_OPTIONS_ID     = 'accept_options_id',
            FIELD_PICKUP_LOCATION_ID    = 'pickup_location_id';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface $pickupLocationRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory $pickupLocationRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface $acceptOptionsPickupLocationRelationRepository
         */
        public function __construct(
            PickupLocationRepositoryInterface $pickupLocationRepository,
            AcceptOptionsPickupLocationRelationInterfaceFactory $acceptOptionsPickupLocationRelationFactory,
            AcceptOptionsPickupLocationRelationRepositoryInterface $acceptOptionsPickupLocationRelationRepository
        )
        {
            $this->_pickupLocationRepository = $pickupLocationRepository;
            $this->_acceptOptionsPickupLocationRelationFactory = $acceptOptionsPickupLocationRelationFactory;
            $this->_acceptOptionsPickupLocationRelationRepository = $acceptOptionsPickupLocationRelationRepository;
        }

        /**
         * {@inheritdoc}
         */
        public function processModelRelation(ModelInterface $model): void
        {
            $pickupLocationRepository = $this->getPickupLocationRepository();
            $acceptOptionsPickupLocationRelationFactory = $this->getAcceptOptionsPickupLocationRelationFactory();
            $acceptOptionsPickupLocationRelationRepository = $this->getAcceptOptionsPickupLocationRelationRepository();

            if($model instanceof AcceptOptionsInterface)
            {
                foreach($model->getPickupLocation() as $pickupLocation)
                {
                    if(!$pickupLocation->getId())
                    {
                        try
                        {
                            $persistedPickupLocation = $pickupLocationRepository->getBySkroutzId($pickupLocation->getSkroutzId());
                            $pickupLocation->setId($persistedPickupLocation->getId());
                        }
                        catch(NoSuchEntityException)
                        {
                            if($pickupLocation instanceof MagentoAbstractModel)
                            {
                                $pickupLocation->isObjectNew(true);
                            }
                        }
                    }
                    $pickupLocationRepository->save($pickupLocation);

                    try
                    {
                        $acceptOptionsPickupLocationRelation = $acceptOptionsPickupLocationRelationRepository->getByAcceptOptionsAndPickupLocation($model, $pickupLocation);
                    }
                    catch(NoSuchEntityException)
                    {
                        $acceptOptionsPickupLocationRelation = $acceptOptionsPickupLocationRelationFactory->create();
                        $acceptOptionsPickupLocationRelation->setAcceptOptions($model);
                        $acceptOptionsPickupLocationRelation->setPickupLocation($pickupLocation);
                        $acceptOptionsPickupLocationRelationRepository->save($acceptOptionsPickupLocationRelation);
                    }
                }
            }
        }

        /**
         * Pickup Location Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface
         */
        private $_pickupLocationRepository;

        /**
         * Gets Pickup Location Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface
         */
        protected function getPickupLocationRepository(): PickupLocationRepositoryInterface
        {
            return $this->_pickupLocationRepository;
        }

        /**
         * Accept Options Pickup Location Relation Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory $_acceptOptionsPickupLocationRelationFactory
         */
        private $_acceptOptionsPickupLocationRelationFactory;

        /**
         * Gets Accept Options Pickup Location Relation Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory
         */
        protected function getAcceptOptionsPickupLocationRelationFactory(): AcceptOptionsPickupLocationRelationInterfaceFactory
        {
            return $this->_acceptOptionsPickupLocationRelationFactory;
        }

        /**
         * Accept Options Pickup Location Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface $_acceptOptionsPickupLocationRelationRepository
         */
        private $_acceptOptionsPickupLocationRelationRepository;

        /**
         * Gets Accept Options Pickup Location Relation Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface
         */
        protected function getAcceptOptionsPickupLocationRelationRepository(): AcceptOptionsPickupLocationRelationRepositoryInterface
        {
            return $this->_acceptOptionsPickupLocationRelationRepository;
        }
    }
?>