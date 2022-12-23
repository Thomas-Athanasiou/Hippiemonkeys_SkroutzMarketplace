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

    use Magento\Sales\Api\Data\OrderInterface as MagentoOrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface as ResourceInterface;

    class OrderRepository
    implements OrderRepositoryInterface
    {
        protected
            $_idIndex           = [],
            $_magentoOrderIndex = [];

        public function __construct(
            ResourceInterface $resource,
            OrderInterfaceFactory $orderFactory
        )
        {
            $this->_resource = $resource;
            $this->_orderFactory = $orderFactory;
        }

        /**
         * {@inheritdoc}
         */
        public function getByCode(string $code) : OrderInterface
        {
            $order = $this->getOrderFactory()->create();
            $this->getResource()->loadOrderByCode($order, $code);

            $id = $order->getId();
            if (!$id)
            {
                throw new NoSuchEntityException(
                    __('The order with code "%1" that was requested doesn\'t exist. Verify the order and try again.', $code)
                );
            }

            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder !== null)
            {
                $this->_magentoOrderIndex[$magentoOrder->getId()] = $order;
            }

            $this->_idIndex[$id] = $order;
            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : OrderInterface
        {
            $order = $this->_idIndex[$id] ?? null;
            if(!$order)
            {
                $order = $this->getOrderFactory()->create();
                $this->getResource()->loadOrderById($order, $id);
                if (!$order->getId())
                {
                    throw new NoSuchEntityException(
                        __('The order with id "%1" that was requested doesn\'t exist. Verify the order and try again.', $id)
                    );
                }

                $magentoOrder = $order->getMagentoOrder();
                if($magentoOrder !== null)
                {
                    $this->_magentoOrderIndex[$magentoOrder->getId()] = $magentoOrder;
                }

                $this->_idIndex[$id] = $order;
            }
            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function getByMagentoOrder(MagentoOrderInterface $magentoOrder) : OrderInterface
        {
            $magentoOrderId = $magentoOrder->getEntityId();
            $order = $this->_magentoOrderIndex[$magentoOrderId] ?? null;
            if(!$order)
            {
                $order = $this->getOrderFactory()->create();
                $this->getResource()->loadOrderByMagentoOrderId($order, $magentoOrderId);
                $id = $order->getId();

                if (!$id)
                {
                    throw new NoSuchEntityException(
                        __('The Order with Magento Order Id "%1" that was requested doesn\'t exist. Verify the Order and try again.', $magentoOrderId)
                    );
                }

                $this->_magentoOrderIndex[$magentoOrderId]  = $magentoOrderId;
                $this->_idIndex[$id] = $order;
            }
            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function save(OrderInterface $order) : OrderInterface
        {
            $this->_idIndex[ $order->getId() ] = $order;
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder !== null)
            {
                $this->_magentoOrderIndex[$magentoOrder->getEntityId()] = $order;
            }
            $this->getResource()->saveOrder($order);

            return $order;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(OrderInterface $order) : bool
        {
            unset( $this->_idIndex[ $order->getId() ] );
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder !== null)
            {
                unset($this->_magentoOrderIndex[$magentoOrder->getEntityId()]);
            }
            return $this->getResource()->deleteOrder($order);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Order Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory $_orderFactory
         */
        private $_orderFactory;

        /**
         * Gets Order Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterfaceFactory
         */
        protected function getOrderFactory(): OrderInterfaceFactory
        {
            return $this->_orderFactory;
        }
    }
?>