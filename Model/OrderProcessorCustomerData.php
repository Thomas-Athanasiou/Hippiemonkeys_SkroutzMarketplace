<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Psr\Log\LoggerInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class OrderProcessorCustomerData
    extends OrderProcessorAbstract
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Psr\Log\LoggerInterface $logger,
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config,
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface $addressRepository,
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface $customerRepository,
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         */
        public function __construct(
            LoggerInterface $logger,
            ConfigInterface $config,
            AddressRepositoryInterface $addressRepository,
            CustomerRepositoryInterface $customerRepository,
            OrderRepositoryInterface $orderRepository
        )
        {
            parent::__construct($logger, $config);
            $this->_addressRepository = $addressRepository;
            $this->_customerRepository = $customerRepository;
            $this->_orderRepository = $orderRepository;
        }

        /**
         * {@inheritdoc}
         */
        protected function processOrderInternal(OrderInterface $order): void
        {
            $customer = $order->getCustomer();
            if($customer !== null)
            {
                $address = $customer->getAddress();
                $customerRepository = $this->getCustomerRepository();

                try
                {
                    $persistentCustomer = $customerRepository->getBySkroutzId($customer->getSkroutzId());
                    $customer->setId($persistentCustomer->getId());
                    $persistentAddress = $persistentCustomer->getAddress();
                    if($persistentAddress !== null && $address !== null)
                    {
                        $address->setId($persistentAddress->getId());
                    }
                }
                catch(NoSuchEntityException)
                {
                    /** Customer doesnt exist in the first place */
                }

                if($address !== null)
                {
                    $this->getAddressRepository()->save($address);
                }

                $customer->setAddress($address);
                $customerRepository->save($customer);
                $order->setCustomer($customer);

                $orderRepository = $this->getOrderRepository();
            }

            try
            {
                $order->setId($orderRepository->getByCode($order->getCode())->getId());
            }
            catch(NoSuchEntityException)
            {
                /** Order Doesnt exist in the first place */
            }

            $orderRepository->save($order);
        }

        /**
         * Address Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface
         */
        private $_addressRepository;

        /**
         * Gets Address Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface
         */
        protected function getAddressRepository() : AddressRepositoryInterface
        {
            return $this->_addressRepository;
        }

        /**
         * Customer Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface
         */
        private $_customerRepository;

        /**
         * Gets Customer Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\CustomerRepositoryInterface
         */
        protected function getCustomerRepository() : CustomerRepositoryInterface
        {
            return $this->_customerRepository;
        }

        /**
         * Order Repository property
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