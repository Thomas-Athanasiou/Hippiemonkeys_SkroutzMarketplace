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

    use Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface as ResourceInterface;

    class RejectOptionsRepository
    implements RejectOptionsRepositoryInterface
    {
        protected
            /**
             * Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface[] $idCache
             */
            $idCache = [],

            /**
             * OrderId Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface[] $orderIdCache
             */
            $orderIdCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterfaceFactory $factory
         */
        public function __construct(
            ResourceInterface $resource,
            RejectOptionsInterfaceFactory $factory
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : RejectOptionsInterface
        {
            $rejectOptions = $this->idCache[$id] ?? null;
            if($rejectOptions === null)
            {
                $rejectOptions = $this->getRejectOptionsFactory()->create();
                $this->getResource()->loadRejectOptionsById($rejectOptions, $id);
                if ($rejectOptions->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The reject options with id "%1" that was requested doesn\'t exist. Verify the reject options and try again.', $id)
                    );
                }

                $this->orderIdCache[$rejectOptions->getOrder()->getId()] = $rejectOptions;
                $this->idCache[$id] = $rejectOptions;
            }
            return $rejectOptions;
        }

        /**
         * @inheritdoc
         */
        public function getByOrder(OrderInterface $order) : RejectOptionsInterface
        {
            $orderId = $order->getId();
            $rejectOptions = $this->orderIdCache[$orderId] ?? null;
            if($rejectOptions === null)
            {
                $rejectOptions = $this->getRejectOptionsFactory()->create();
                $this->getResource()->loadRejectOptionsByOrderId($rejectOptions, $orderId);
                $id = $rejectOptions->getId();
                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The reject options with order id "%1" that was requested doesn\'t exist. Verify the reject options and try again.', $orderId)
                    );
                }

                $this->orderIdCache[$orderId] = $rejectOptions;
                $this->idCache[$id] = $rejectOptions;
            }
            return $rejectOptions;
        }

        /**
         * @inheritdoc
         */
        public function save(RejectOptionsInterface $rejectOptions) : RejectOptionsInterface
        {
            $this->idCache[$rejectOptions->getId()] = $rejectOptions;
            $this->orderIdCache[$rejectOptions->getOrder()->getId()] = $rejectOptions;
            $this->getResource()->saveRejectOptions($rejectOptions);
            return $rejectOptions;
        }

        /**
         * @inheritdoc
         */
        public function delete(RejectOptionsInterface $rejectOptions) : bool
        {
            unset($this->idCache[$rejectOptions->getId()]);
            unset($this->orderIdCache[$rejectOptions->getOrder()->getId()]);
            return $this->getResource()->deleteRejectOptions($rejectOptions);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface $resource
         */
        private $resource;

        /**
         * Gets resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface $resource
         */
        protected function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Reject Options Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Reject Options Factory
         *
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterfaceFactory
         */
        protected function getRejectOptionsFactory() : RejectOptionsInterfaceFactory
        {
            return $this->factory;
        }
    }
?>