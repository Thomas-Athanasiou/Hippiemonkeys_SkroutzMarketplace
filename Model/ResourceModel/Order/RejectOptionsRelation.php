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

    use Magento\Framework\Model\AbstractModel,
        Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class RejectOptionsRelation
    implements RelationInterface
    {
        /**
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface
         */
        private $_rejectOptionsRepository;

        /**
         * Gets Reject Options Repository
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface
         */
        protected function getRejectOptionsRepository()
        {
            return $this->_rejectOptionsRepository;
        }
    }
?>