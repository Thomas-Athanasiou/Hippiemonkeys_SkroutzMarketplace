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

    use Psr\Log\LoggerInterface,
        Magento\InventorySalesApi\Api\GetProductSalableQtyInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface;

    class OrderProcessorOrderAccept
    extends OrderProcessorAbstract
    {
        protected const
            CONFIG_SEND_INVOICE_EMAIL = 'send_invoice_email',
            CONFIG_SEND_SHIPMENT_EMAIL = 'send_shipment_email',
            CONFIG_PREFERED_ACCEPT_OPTIONS_PICKUP_LOCATION_ID = 'preferred_accept_options_pickup_location_skroutz_id',
            CONFIG_PREFERED_NUMBER_OF_PARCELS =  'preferred_number_of_parcels';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface $skroutzMarketplace
         */
        public function __construct(
            LoggerInterface $logger,
            ConfigInterface $config,
            SkroutzMarketplaceInterface $skroutzMarketplace
        )
        {
            parent::__construct($logger, $config);
            $this->_skroutzMarketplace = $skroutzMarketplace;
        }

        /**
         * {@inheritdoc}
         */
        protected function processOrderInternal(OrderInterface $order): void
        {
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder !== null)
            {
                switch($order->getState())
                {
                    case OrderInterface::STATE_OPEN;
                        if($this->getIsOrderSalable($order))
                        {
                            $selectedPickupLocation = null;
                            $selectedPickupWindow = null;

                            $acceptOptions = $order->getAcceptOptions();

                            $pickupLocations = $acceptOptions->getPickupLocation();
                            if(count($pickupLocations) > 0)
                            {
                                $selectedPickupLocation = $pickupLocations[0];
                                $preferedPickupLocationSkroutzId = $this->getPreferedPickupLocationSkroutzId();
                                foreach($pickupLocations as $pickupLocation)
                                {
                                    if($preferedPickupLocationSkroutzId === $pickupLocation->getSkroutzId())
                                    {
                                        $selectedPickupLocation = $pickupLocation;
                                    }
                                }

                            }

                            $pickupWindows = $acceptOptions->getPickupWindow();
                            $pickupLocationsCount = count($pickupLocations);
                            if($pickupLocationsCount > 0)
                            {
                                $selectedPickupWindow = $pickupWindows[$pickupLocationsCount - 1];
                            }

                            if($selectedPickupLocation !== null && $selectedPickupWindow !== null)
                            {
                                $this->getSkroutzMarketplace()->acceptOrder(
                                    $order,
                                    $this->getPreferedNumberOfParcels(),
                                    $selectedPickupLocation,
                                    $selectedPickupWindow
                                );
                            }
                            break;
                        }
                }
            }
        }

        /**
         * Gets Prefered Pickup Location Skroutz Id
         *
         * @access protected
         *
         * @return string
         */
        protected function getPreferedPickupLocationSkroutzId(): string
        {
            return $this->getConfig()->getData(static::CONFIG_PREFERED_ACCEPT_OPTIONS_PICKUP_LOCATION_ID);
        }

        /**
         * Gets Prefered Number of Parcels
         *
         * @access protected
         *
         * @return int
         */
        protected function getPreferedNumberOfParcels(): int
        {
            return (int) $this->getConfig()->getData(static::CONFIG_PREFERED_NUMBER_OF_PARCELS);
        }

        /**
         * Checks if the given order is Salable
         *
         * @access protected
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return bool
         */
        protected function getIsOrderSalable(OrderInterface $order): bool
        {
            $isSalable = true;

            $productSalableQtyService = $this->getProductSalableQtyService();
            $stockId = $this->getStockId();
            foreach ($order->getLineItems() as $lineItem)
            {
                if($productSalableQtyService->execute($lineItem->getProduct()->getSku(), $stockId) < 1)
                {
                    $isSalable = false;
                }
            }

            return $isSalable;
        }

        /**
         * Gets Product Salable Qty Service
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface
         */
        protected function getProductSalableQtyService(): GetProductSalableQtyInterface
        {
            return $this->_productSalableQtyService;
        }

        /**
         * Skroutz Marketplace property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface
         */
        private $_skroutzMarketplace;

        /**
         * Gets Skroutz Marketplace
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface
         */
        protected function getSkroutzMarketplace(): SkroutzMarketplaceInterface
        {
            return $this->_skroutzMarketplace;
        }
    }
?>