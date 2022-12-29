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
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface[] $_idCache
             */
            $_idCache = [],

            /**
             * OrderId Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface[] $_orderIdCache
             */
            $_orderIdCache = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterfaceFactory $rejectOptionsFactory
         */
        public function __construct(
            ResourceInterface $resource,
            RejectOptionsInterfaceFactory $rejectOptionsFactory
        )
        {
            $this->_resource = $resource;
            $this->_rejectOptionsFactory = $rejectOptionsFactory;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : RejectOptionsInterface
        {
            $rejectOptions = $this->_idCache[$id] ?? null;
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

                $this->_orderIdCache[$rejectOptions->getOrder()->getId()] = $rejectOptions;
                $this->_idCache[$id] = $rejectOptions;
            }
            return $rejectOptions;
        }

        /**
         * {@inheritdoc}
         */
        public function getByOrder(OrderInterface $order) : RejectOptionsInterface
        {
            $orderId = $order->getId();
            $rejectOptions = $this->_orderIdCache[$orderId] ?? null;
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

                $this->_orderIdCache[$orderId] = $rejectOptions;
                $this->_idCache[$id] = $rejectOptions;
            }
            return $rejectOptions;
        }

        /**
         * {@inheritdoc}
         */
        public function save(RejectOptionsInterface $rejectOptions) : RejectOptionsInterface
        {
            $this->_idCache[$rejectOptions->getId()] = $rejectOptions;
            $this->_orderIdCache[$rejectOptions->getOrder()->getId()] = $rejectOptions;
            $this->getResource()->saveRejectOptions($rejectOptions);
            return $rejectOptions;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(RejectOptionsInterface $rejectOptions) : bool
        {
            unset($this->_idCache[$rejectOptions->getId()]);
            unset($this->_orderIdCache[$rejectOptions->getOrder()->getId()]);
            return $this->getResource()->deleteRejectOptions($rejectOptions);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectOptionsResourceInterface $_resource
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Reject Options Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterfaceFactory $_rejectOptionsFactory
         */
        private $_rejectOptionsFactory;

        /**
         * Gets Reject Options Factory
         *
         * @access private
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterfaceFactory
         */
        protected function getRejectOptionsFactory() : RejectOptionsInterfaceFactory
        {
            return $this->_rejectOptionsFactory;
        }
    }
?>