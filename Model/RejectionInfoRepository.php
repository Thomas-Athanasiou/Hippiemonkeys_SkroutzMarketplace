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

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectionInfoRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectionInfoResourceInterface as ResourceInterface;

    class RejectionInfoRepository
    implements RejectionInfoRepositoryInterface
    {
        protected
            /**
             * Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface[] $idCache
             */
            $idCache = [];

        public function __construct(
            ResourceInterface $resource,
            RejectionInfoInterfaceFactory $factory
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : RejectionInfoInterface
        {
            $rejectionInfo = $this->idCache[$id] ?? null;
            if($rejectionInfo === null)
            {
                $rejectionInfo = $this->getFactory()->create();
                $this->getResource()->loadRejectionInfoById($rejectionInfo, $id, ResourceInterface::FIELD_ID);
                if ($rejectionInfo->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Rejection Info with id "%1" that was requested doesn\'t exist. Verify the Rejection Info and try again.', $id)
                    );
                }
                else
                {
                    $this->idCache[$id] = $rejectionInfo;
                }
            }

            return $rejectionInfo;
        }

        /**
         * @inheritdoc
         */
        public function save(RejectionInfoInterface $rejectionInfo) : RejectionInfoInterface
        {
            $this->getResource()->saveRejectionInfo($rejectionInfo);
            $this->idCache[$rejectionInfo->getId()] = $rejectionInfo;
            return $rejectionInfo;
        }

        /**
         * @inheritdoc
         */
        public function delete(RejectionInfoInterface $rejectionInfo) : bool
        {
            unset($this->idCache[$rejectionInfo->getId()]);
            return $this->getResource()->deleteRejectionInfo($rejectionInfo);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectionInfoResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectionInfoResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Rejection Info Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Rejection Info Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterfaceFactory
         */
        protected function getFactory() : RejectionInfoInterfaceFactory
        {
            return $this->factory;
        }
    }
?>