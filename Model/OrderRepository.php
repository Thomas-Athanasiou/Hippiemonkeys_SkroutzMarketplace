<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Magento\Sales\Api\Data\OrderInterface as MagentoOrderInterface,
        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Order as ResourceModel;

    class OrderRepository
    implements OrderRepositoryInterface
    {
        protected
            $_idIndex           = [],
            $_magentoOrderIndex = [];

        public function __construct(
            ResourceModel $resourceModel,
            OrderInterfaceFactory $orderFactory
        )
        {
            $this->_resourceModel   = $resourceModel;
            $this->_orderFactory    = $orderFactory;
        }

        /**
         * @inheritdoc
         */
        public function getByCode(string $code) : OrderInterface
        {
            $order = $this->getOrderFactory()->create();
            $this->getResourceModel()->load($order, $code, ResourceModel::FIELD_CODE);
            $id = $order->getId();
            if (!$id)
            {
                throw new NoSuchEntityException(
                    __('The order with code "%1" that was requested doesn\'t exist. Verify the order and try again.', $code)
                );
            }
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder)
            {
                $this->_magentoOrderIndex[ $magentoOrder->getId() ] = $order;
            }
            $this->_idIndex[$id]        = $order;
            return $order;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : OrderInterface
        {
            $order = $this->_idIndex[$id] ?? null;
            if(!$order)
            {
                $order = $this->getOrderFactory()->create();
                $this->getResourceModel()->load($order, $id, ResourceModel::FIELD_ID);
                if (!$order->getId())
                {
                    throw new NoSuchEntityException(
                        __('The order with id "%1" that was requested doesn\'t exist. Verify the order and try again.', $id)
                    );
                }
                $magentoOrder = $order->getMagentoOrder();
                if($magentoOrder)
                {
                    $this->_magentoOrderIndex[ $magentoOrder->getId() ] = $magentoOrder;
                }
                $this->_idIndex[$id] = $order;
            }
            return $order;
        }

        /**
         * @inheritdoc
         */
        public function getByMagentoOrder(MagentoOrderInterface $magentoOrder) : OrderInterface
        {
            $magentoOrderId = $magentoOrder->getId();
            $order          = $this->_magentoOrderIndex[$magentoOrderId] ?? null;
            if(!$order) {
                $order = $this->getOrderFactory()->create();
                $order->loadByMagentoOrder($magentoOrder);
                $id = $order->getId();
                if (!$id)
                {
                    throw new NoSuchEntityException(
                        __('The order with magento order id "%1" that was requested doesn\'t exist. Verify the order and try again.', $magentoOrderId)
                    );
                }
                $this->_magentoOrderIndex[$magentoOrderId]  = $magentoOrderId;
                $this->_idIndex[$id]                        = $order;
            }
            return $order;
        }

        /**
         * @inheritdoc
         */
        public function save(OrderInterface $order) : OrderInterface
        {
            $order->getResource()->save($order);
            $this->_idIndex[ $order->getId() ] = $order;
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder)
            {
                $this->_magentoOrderIndex[ $magentoOrder->getId() ] = $order;
            }
            return $order;
        }

        /**
         * @inheritdoc
         */
        public function delete(OrderInterface $order) : bool
        {
            $order->getResource()->delete($order);
            unset( $this->_idIndex[ $order->getId() ] );
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder)
            {
                unset( $this->_magentoOrderIndex[ $magentoOrder->getId() ] );
            }
            return $order->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_orderFactory;
        protected function getOrderFactory() : OrderInterfaceFactory
        {
            return $this->_orderFactory;
        }
    }
?>