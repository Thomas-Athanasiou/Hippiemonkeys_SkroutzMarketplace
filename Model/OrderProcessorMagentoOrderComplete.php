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
        Magento\Sales\Model\Order as MagentoOrder,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\Sales\Api\Helper\InvoiceHelperInterface,
        Hippiemonkeys\Sales\Api\Helper\ShipmentHelperInterface,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface;

    class OrderProcessorMagentoOrderComplete
    extends OrderProcessorAbstract
    {
        protected const
            CONFIG_SEND_INVOICE_EMAIL = 'send_invoice_email',
            CONFIG_SEND_SHIPMENT_EMAIL = 'send_shipment_email';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config
         * @param \Hippiemonkeys\Sales\Api\Helper\InvoiceHelperInterface $invoiceHelper
         * @param \Hippiemonkeys\Sales\Api\Helper\ShipmentHelperInterface $shipmentHelper
         */
        public function __construct(
            LoggerInterface $logger,
            ConfigInterface $config,
            InvoiceHelperInterface $invoiceHelper,
            ShipmentHelperInterface $shipmentHelper
        )
        {
            parent::__construct($logger, $config);
            $this->_invoiceHelper = $invoiceHelper;
            $this->_shipmentHelper = $shipmentHelper;
        }

        /**
         * {@inheritdoc}
         */
        protected function processOrderInternal(OrderInterface $order): void
        {
            $magentoOrder = $order->getMagentoOrder();
            if($magentoOrder !== null)
            {
                $config = $this->getConfig();
                switch($order->getState())
                {
                    case OrderInterface::STATE_ACCEPTED:
                    case OrderInterface::STATE_DISPATCHED:
                    case OrderInterface::STATE_DELIVERED:
                        try
                        {
                            if($magentoOrder instanceof MagentoOrder)
                            {
                                if(!$magentoOrder->hasInvoices())
                                {
                                    $this->getInvoiceHelper()->doInvoiceRequest(
                                        $magentoOrder,
                                        $config->getFlag(self::CONFIG_SEND_INVOICE_EMAIL)
                                    );
                                }
                                if(!$magentoOrder->hasShipments())
                                {
                                    $this->getShipmentHelper()->doShipmentRequest(
                                        $magentoOrder,
                                        new \Magento\Framework\DataObject(),
                                        $config->getFlag(self::CONFIG_SEND_SHIPMENT_EMAIL),
                                        false
                                    );
                                }
                            }
                        }
                        catch(\Exception $exception)
                        {
                            $this->getLogger()->error($exception->getMessage());
                        }
                        break;
                }
            }
        }

        /**
         * Invoice Helper property
         *
         * @access private
         *
         * @var \Hippiemonkeys\Sales\Api\Helper\InvoiceHelperInterface
         */
        private $_invoiceHelper;

        /**
         * Gets Invoice Helper
         *
         * @access protected
         *
         * @return \Hippiemonkeys\Sales\Api\Helper\InvoiceHelperInterface
         */
        protected function getInvoiceHelper() : InvoiceHelperInterface
        {
            return $this->_invoiceHelper;
        }

        /**
         * Shipment Helper property
         *
         * @access private
         *
         * @var \Hippiemonkeys\Sales\Api\Helper\ShipmentHelperInterface
         */
        private $_shipmentHelper;

        /**
         * Gets Shipment Helper
         *
         * @access protected
         *
         * @return \Hippiemonkeys\Sales\Api\Helper\ShipmentHelperInterface
         */
        protected function getShipmentHelper() : ShipmentHelperInterface
        {
            return $this->_shipmentHelper;
        }
    }
?>