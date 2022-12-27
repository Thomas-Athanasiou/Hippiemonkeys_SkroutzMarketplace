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

    use Hippiemonkeys\Core\Api\Data\ModelInterface,
        Hippiemonkeys\Core\Model\Spi\ModelRelationProcessorInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class AcceptOptionsRelation
    implements ModelRelationProcessorInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
         */
        public function __construct(
            AcceptOptionsRepositoryInterface $acceptOptionsRepository
        )
        {
            $this->_acceptOptionsRepository = $acceptOptionsRepository;
        }

        /**
         * {@inheritdoc}
         */
        public function processModelRelation(ModelInterface $model): void
        {
            $acceptOptionsRepository = $this->getAcceptOptionsRepository();
            if($model instanceof OrderInterface)
            {
                $acceptOptions = $model->getAcceptOptions();

                try
                {
                    $persistedAcceptOptions = $acceptOptionsRepository->getByOrder($model);
                    if($acceptOptions)
                    {
                        $acceptOptions->setId(
                            $persistedAcceptOptions->getId()
                        );
                    }
                    else
                    {
                        $acceptOptionsRepository->delete($persistedAcceptOptions);
                    }
                }
                catch(NoSuchEntityException)
                {

                }

                if($acceptOptions)
                {
                    $acceptOptions->setOrder($model);
                    $acceptOptionsRepository->save($acceptOptions);
                }
            }
        }

        /**
         * Accept Options Repository property
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface
         */
        private $_acceptOptionsRepository;

        /**
         * Gets Accept Options Repository
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface
         */
        protected function getAcceptOptionsRepository()
        {
            return $this->_acceptOptionsRepository;
        }
    }
?>