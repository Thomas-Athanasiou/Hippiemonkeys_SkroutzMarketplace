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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsResourceInterface as ResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class AcceptOptionsRepository
    implements AcceptOptionsRepositoryInterface
    {
        protected
            /**
             * Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface $idCache
             */
            $idCache = [],

            /**
             * Order Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface $orderIdCache
             */
            $orderIdCache  = [];

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsResourceInterface $resource
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterfaceFactory $factory
         */
        public function __construct(
            ResourceInterface $resource,
            AcceptOptionsInterfaceFactory $factory
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id): AcceptOptionsInterface
        {
            $acceptOptions = $this->idCache[$id] ?? null;

            if($acceptOptions === null)
            {
                $acceptOptions = $this->getFactory()->create();
                $this->getResource()->loadAcceptOptionsById($acceptOptions, $id);
                if ($acceptOptions->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The accept options with id "%1" that was requested doesn\'t exist. Verify the accept options and try again.', $id)
                    );
                }
                else
                {
                    $this->orderIdCache[$acceptOptions->getOrder()->getId()] = $acceptOptions;
                    $this->idCache[$id] = $acceptOptions;
                }
            }

            return $acceptOptions;
        }

        /**
         * @inheritdoc
         */
        public function getByOrder(OrderInterface $order): AcceptOptionsInterface
        {
            $orderId = $order->getId();
            $acceptOptions = $this->orderIdCache[$orderId] ?? null;
            if($acceptOptions === null)
            {
                $acceptOptions = $this->getFactory()->create();
                $this->getResource()->loadAcceptOptionsByOrderId($acceptOptions, $orderId);
                $id = $acceptOptions->getId();
                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Accept Options with Order Id "%1" that was requested doesn\'t exist. Verify the Accept Options and try again.', $orderId)
                    );
                }
                else
                {
                    $this->orderIdCache[$orderId] = $acceptOptions;
                    $this->idCache[$id] = $acceptOptions;
                }
            }
            return $acceptOptions;
        }

        /**
         * @inheritdoc
         */
        public function save(AcceptOptionsInterface $acceptOptions): AcceptOptionsInterface
        {
            $this->getResource()->saveAcceptOptions($acceptOptions);
            $this->idCache[$acceptOptions->getId()] = $acceptOptions;
            return $acceptOptions;
        }

        /**
         * @inheritdoc
         */
        public function delete(AcceptOptionsInterface $acceptOptions): bool
        {
            unset($this->orderIdCache[$acceptOptions->getOrder()->getId()]);
            unset($this->idCache[$acceptOptions->getId()]);
            return $this->getResource()->deleteAcceptOptions($acceptOptions);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsResourceInterface
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterfaceFactory
         */
        protected final function getFactory() : AcceptOptionsInterfaceFactory
        {
            return $this->factory;
        }
    }
?>