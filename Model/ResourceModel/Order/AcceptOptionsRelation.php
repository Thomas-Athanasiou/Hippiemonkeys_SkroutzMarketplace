<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Order;

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException;

    class AcceptOptionsRelation
    implements RelationInterface
    {
        /**
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
         */
        public function __construct(
            AcceptOptionsRepositoryInterface $acceptOptionsRepository
        )
        {
            $this->_acceptOptionsRepository = $acceptOptionsRepository;
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
            $acceptOptionsRepository    = $this->getAcceptOptionsRepository();
            $acceptOptions              = $object->getAcceptOptions();
            try
            {
                $persistedAcceptOptions = $acceptOptionsRepository->getByOrder($object);
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
            catch(NoSuchEntityException $exception)
            {

            }

            if($acceptOptions)
            {
                $acceptOptions->setOrder($object);
                $acceptOptionsRepository->save($acceptOptions);
            }
        }

        /**
         * Accept Options Repository property
         *
         * @var \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface
         */
        private $_acceptOptionsRepository;

        /**
         * Gets Accept Options Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface
         */
        protected function getAcceptOptionsRepository()
        {
            return $this->_acceptOptionsRepository;
        }
    }
?>