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
        Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory,
        Magento\Framework\Exception\NoSuchEntityException;

    class PickupLocationRelation
    implements ModelRelationProcessorInterface
    {
        protected const
            FIELD_ACCEPT_OPTIONS_ID = 'accept_options_id',
            FIELD_PICKUP_LOCATION_ID = 'pickup_location_id';

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
            $this->pickupLocationRepository = $pickupLocationRepository;
            $this->acceptOptionsPickupLocationRelationFactory = $acceptOptionsPickupLocationRelationFactory;
            $this->acceptOptionsPickupLocationRelationRepository = $acceptOptionsPickupLocationRelationRepository;
        }

        /**
         * @inheritdoc
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
                    if($pickupLocation->getId() === null)
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface $pickupLocationRepository
         */
        private $pickupLocationRepository;

        /**
         * Gets Pickup Location Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface
         */
        protected final function getPickupLocationRepository(): PickupLocationRepositoryInterface
        {
            return $this->pickupLocationRepository;
        }

        /**
         * Accept Options Pickup Location Relation Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory $acceptOptionsPickupLocationRelationFactory
         */
        private $acceptOptionsPickupLocationRelationFactory;

        /**
         * Gets Accept Options Pickup Location Relation Factory
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterfaceFactory
         */
        protected final function getAcceptOptionsPickupLocationRelationFactory(): AcceptOptionsPickupLocationRelationInterfaceFactory
        {
            return $this->acceptOptionsPickupLocationRelationFactory;
        }

        /**
         * Accept Options Pickup Location Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface $acceptOptionsPickupLocationRelationRepository
         */
        private $acceptOptionsPickupLocationRelationRepository;

        /**
         * Gets Accept Options Pickup Location Relation Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsPickupLocationRelationRepositoryInterface
         */
        protected final function getAcceptOptionsPickupLocationRelationRepository(): AcceptOptionsPickupLocationRelationRepositoryInterface
        {
            return $this->acceptOptionsPickupLocationRelationRepository;
        }
    }
?>