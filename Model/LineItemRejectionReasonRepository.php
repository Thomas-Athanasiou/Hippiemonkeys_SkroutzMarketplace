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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemRejectionReasonResourceInterface as ResourceInterface;

    class LineItemRejectionReasonRepository
    implements LineItemRejectionReasonRepositoryInterface
    {
        protected
            /**
             * Id Index property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonRepositoryInterface[] $idCache
             */
            $idCache = [],


            /**
             * Skroutz Id Index property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonRepositoryInterface[] $skroutzIdCache
             */
            $skroutzIdCache = [];

        public function __construct(
            ResourceInterface $resource,
            LineItemRejectionReasonInterfaceFactory $lineItemRejectionReasonFactory
        )
        {
            $this->resource = $resource;
            $this->factory = $lineItemRejectionReasonFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : LineItemRejectionReasonInterface
        {
            $lineItemRejectionReason = $this->idCache[$id] ?? null;
            if($lineItemRejectionReason === null)
            {
                $lineItemRejectionReason = $this->getFactory()->create();
                $this->getResource()->loadLineItemRejectionReasonById($lineItemRejectionReason, $id);
                if ($lineItemRejectionReason->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Line Item Rejection Reason with id "%1" that was requested doesn\'t exist. Verify the Line Item Rejection Reason and try again.', $id)
                    );
                }
                else
                {
                    $this->idCache[$id] = $lineItemRejectionReason;
                    $this->skroutzIdCache[$lineItemRejectionReason->getSkroutzId()]  = $lineItemRejectionReason;
                }
            }
            return $lineItemRejectionReason;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(int $skroutzId) : LineItemRejectionReasonInterface
        {
            $lineItemRejectionReason = $this->skroutzIdCache[$skroutzId] ?? null;
            if($lineItemRejectionReason === null)
            {
                $lineItemRejectionReason = $this->getFactory()->create();
                $this->getResource()->loadLineItemRejectionReasonBySkroutzId($lineItemRejectionReason, $skroutzId);
                $id = $lineItemRejectionReason->getId();
                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Line Item Rejection Reason with Skroutz Id "%0" that was requested doesn\'t exist. Verify the Line Item Rejection Reason and try again.', $skroutzId)
                    );
                }
                else
                {
                    $this->idCache[$id] = $lineItemRejectionReason;
                    $this->skroutzIdCache[$skroutzId] = $lineItemRejectionReason;
                }
            }
            return $lineItemRejectionReason;
        }

        /**
         * @inheritdoc
         */
        public function save(LineItemRejectionReasonInterface $lineItemRejectionReason) : LineItemRejectionReasonInterface
        {
            $this->idCache[$lineItemRejectionReason->getId()] = $lineItemRejectionReason;
            $this->skroutzIdCache[$lineItemRejectionReason->getSkroutzId()]  = $lineItemRejectionReason;
            $this->getResource()->saveLineItemRejectionReason($lineItemRejectionReason);
            return $lineItemRejectionReason;
        }

        /**
         * @inheritdoc
         */
        public function delete(LineItemRejectionReasonInterface $lineItemRejectionReason) : bool
        {
            unset($this->idCache[$lineItemRejectionReason->getId()]);
            unset($this->skroutzIdCache[$lineItemRejectionReason->getSkroutzId()]);
            return $this->getResource()->deleteLineItemRejectionReason($lineItemRejectionReason);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemRejectionReasonResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemRejectionReasonResourceInterface
         */
        protected final function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterfaceFactory
         */
        protected function getFactory() : LineItemRejectionReasonInterfaceFactory
        {
            return $this->factory;
        }
    }
?>