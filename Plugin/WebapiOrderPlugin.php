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

    namespace Hippiemonkeys\SkroutzMarketplace\Plugin;

    use Hippiemonkeys\SkroutzMarketplace\Api\OrderManagementInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class WebapiOrderPlugin
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         */
        public function __construct(
            OrderRepositoryInterface $orderRepository
        )
        {
            $this->_orderRepository = $orderRepository;
        }

        /**
         * After Get Order Event
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderManagementInterface $orderManagement
         * @param string $eventType
         * @param string $eventTime
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return mixed[]
         */
        public function afterGetOrder(OrderManagementInterface $orderManagement, string $eventType, string $eventTime, OrderInterface $order): array
        {
            $id = $order->getId();
            if($id === null)
            {
                try
                {
                    $persistedOrder = $this->getOrderRepository()->getByCode($order->getCode());
                    $order->setId($persistedOrder->getId());
                    $order->setMagentoOrder($persistedOrder->getMagentoOrder());
                }
                catch(NoSuchEntityException)
                {
                    /** Order doesnt exist in the first place */
                }
            }

            return $order;
        }

        /**
         * Order Repository Interface
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        private $_orderRepository;

        /**
         * Gets Order Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface
         */
        protected function getOrderRepository() : OrderRepositoryInterface
        {
            return $this->_orderRepository;
        }
    }
?>