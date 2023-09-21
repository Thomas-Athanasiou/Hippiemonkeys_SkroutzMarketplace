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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Order;

    use Hippiemonkeys\Core\Api\Data\ModelInterface,
        Hippiemonkeys\Core\Model\Spi\ModelRelationProcessorInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class RejectOptionsRelation
    implements ModelRelationProcessorInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface
         */
        public function __construct(RejectOptionsRepositoryInterface $rejectOptionsRepository)
        {
            $this->_rejectOptionsRepository = $rejectOptionsRepository;
        }

        /**
         * @inheritdoc
         */
        public function processModelRelation(ModelInterface $model): void
        {
            $rejectOptionsRepository = $this->getRejectOptionsRepository();
            if($model instanceof OrderInterface)
            {
                $rejectOptions = $model->getRejectOptions();
                try
                {
                    $persistedRejectOptions = $rejectOptionsRepository->getByOrder($model);
                    if($rejectOptions === null)
                    {
                        $rejectOptionsRepository->delete($persistedRejectOptions);
                    }
                    else
                    {
                        $rejectOptions->setId($persistedRejectOptions->getId());
                    }
                }
                catch(NoSuchEntityException)
                {

                }

                if($rejectOptions !== null)
                {
                    $rejectOptions->setOrder($model);
                    $rejectOptionsRepository->save($rejectOptions);
                }
            }
        }

        /**
         * Reject Options Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface
         */
        private $_rejectOptionsRepository;

        /**
         * Gets Reject Options Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface
         */
        protected function getRejectOptionsRepository(): RejectOptionsRepositoryInterface
        {
            return $this->_rejectOptionsRepository;
        }
    }
?>