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
        Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException;

    class RejectOptionsRelation
    implements RelationInterface
    {
        /**
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface
         */
        public function __construct(
            RejectOptionsRepositoryInterface $rejectOptionsRepository
        )
        {
            $this->_rejectOptionsRepository = $rejectOptionsRepository;
        }

        /**
         * Save relations for reject options
         *
         * @param \Magento\Framework\Model\AbstractModel $object
         * @return void
         * @throws \Exception
         */
        public function processRelation(AbstractModel $object)
        {
            $rejectOptionsRepository    = $this->getRejectOptionsRepository();
            $rejectOptions              = $object->getRejectOptions();
            try
            {
                $persistedRejectOptions = $rejectOptionsRepository->getByOrder($object);
                if($rejectOptions)
                {
                    $rejectOptions->setId(
                        $persistedRejectOptions->getId()
                    );
                }
                else
                {
                    $rejectOptionsRepository->delete($persistedRejectOptions);
                }
            }
            catch(NoSuchEntityException $exception)
            {

            }
            if($rejectOptions)
            {
                $rejectOptions->setOrder($object);
                $rejectOptionsRepository->save($rejectOptions);
            }
        }

        /**
         * Reject Options Repository property
         *
         * @var \Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface
         */
        private $_rejectOptionsRepository;

        /**
         * Gets Reject Options Repository
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface
         */
        protected function getRejectOptionsRepository()
        {
            return $this->_rejectOptionsRepository;
        }
    }
?>