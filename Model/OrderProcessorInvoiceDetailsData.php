<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Psr\Log\LoggerInterface,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class OrderProcessorInvoiceDetailsData
    extends OrderProcessorAbstract
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface $addressRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface $invoiceDetailsRepository
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\OrderRepositoryInterface $orderRepository
         */
        public function __construct(
            LoggerInterface $logger,
            ConfigInterface $config,
            AddressRepositoryInterface $addressRepository,
            InvoiceDetailsRepositoryInterface $invoiceDetailsRepository,
            OrderRepositoryInterface $orderRepository
        )
        {
            parent::__construct($logger, $config);
            $this->_addressRepository = $addressRepository;
            $this->_invoiceDetailsRepository = $invoiceDetailsRepository;
            $this->_orderRepository = $orderRepository;
        }

        /**
         * {@inheritdoc}
         */
        protected function processOrderInternal(OrderInterface $order): void
        {
            $orderRepository = $this->getOrderRepository();
            $invoiceDetails = $order->getInvoiceDetails();

            $persistentOrder = null;
            try
            {
                $persistentOrder = $orderRepository->getByCode($order->getCode());
                $order->setId($persistentOrder->getId());
            }
            catch(NoSuchEntityException)
            {
                /** Order doesnt exist in the first place */
            }

            if($invoiceDetails !== null)
            {
                $address = $invoiceDetails->getAddress();

                $persistentInvoiceDetails = $persistentOrder === null ? null : $persistentOrder->getInvoiceDetails();
                if($persistentInvoiceDetails !== null)
                {
                    $invoiceDetails->setId($persistentInvoiceDetails->getId());
                    $persistentAddress = $persistentInvoiceDetails->getAddress();
                    if($persistentAddress !== null)
                    {
                        if($address !== null)
                        {
                            $address->setId($persistentAddress->getId());
                        }
                    }

                    $this->getAddressRepository()->save($address);
                    $invoiceDetails->setAddress($address);
                }
                if($this->getIsActive())
                {
                    $this->getInvoiceDetailsRepository()->save($invoiceDetails);
                    $order->setInvoiceDetails($invoiceDetails);
                }
            }
            $orderRepository->save($order);
        }

        /**
         * Gets Save Invoice Details Active flag
         *
         * @access protected
         *
         * @return bool
         */
        protected function getSaveInvoiceDetailsActive(): bool
        {
            return $this->getConfig()->getFlag(static::CONFIG_SAVE_INVOICE_DETAILS);
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
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\AddressRepositoryInterface
         */
        protected function getAddressRepository() : AddressRepositoryInterface
        {
            return $this->_addressRepository;
        }

        /**
         * Invoice Details Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface
         */
        private $_invoiceDetailsRepository;

        /**
         * Gets Invoice Details Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\InvoiceDetailsRepositoryInterface
         */
        protected function getInvoiceDetailsRepository() : InvoiceDetailsRepositoryInterface
        {
            return $this->_invoiceDetailsRepository;
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