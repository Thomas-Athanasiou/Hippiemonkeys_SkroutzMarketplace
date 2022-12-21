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
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class AcceptOptionsRelation
    implements RelationInterface
    {
        /**
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface $acceptOptionsRepository
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