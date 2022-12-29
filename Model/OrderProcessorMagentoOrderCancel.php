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
        Magento\Sales\Api\OrderManagementInterface as MagentoOrderManagementInterface,
        Magento\Sales\Model\Order as MagentoOrder,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\Sales\Api\Helper\CreditMemoHelperInterface,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface;

    class OrderProcessorMagentoOrderCancel
    extends OrderProcessorAbstract
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config
         * @param \Magento\Sales\Api\OrderManagementInterface $magentoOrderManagement
         */
        public function __construct(
            LoggerInterface $logger,
            ConfigInterface $config,
            CreditMemoHelperInterface $creditMemoHelper,
            MagentoOrderManagementInterface $magentoOrderManagement
        )
        {
            parent::__construct($logger, $config);
            $this->_creditMemoHelper = $creditMemoHelper;
            $this->_magentoOrderManagement = $magentoOrderManagement;
        }

        /**
         * {@inheritdoc}
         */
        protected function processOrderInternal(OrderInterface $order): void
        {
            if($this->getIsActive())
            {
                $magentoOrder = $order->getMagentoOrder();
                if($magentoOrder !== null)
                {
                    switch($order->getState())
                    {
                        case OrderInterface::STATE_RETURNED:
                        case OrderInterface::STATE_CANCELLED:
                        case OrderInterface::STATE_REJECTED:
                        case OrderInterface::STATE_EXPIRED:
                            if($magentoOrder instanceof MagentoOrder)
                            {
                                if($magentoOrder->hasShipments())
                                {
                                    $this->getCreditMemoHelper()->doCreditMemoRequest(
                                        $magentoOrder,
                                        false // TODO EMAIL
                                    );
                                }
                                else if(!$magentoOrder->isCanceled())
                                {
                                    $this->getMagentoOrderManagement()->cancel($magentoOrder->getId());
                                }
                            }
                            break;
                    }
                }
            }
        }

        /**
         * Credit Memo Helper property
         *
         * @access private
         *
         * @var \Hippiemonkeys\Sales\Api\Helper\CreditMemoHelperInterface
         */
        private $_creditMemoHelper;

        /**
         * Gets Credit Memo Helper
         *
         * @access protected
         *
         * @return \Hippiemonkeys\Sales\Api\Helper\CreditMemoHelperInterface
         */
        protected function getCreditMemoHelper() : CreditMemoHelperInterface
        {
            return $this->_creditMemoHelper;
        }

        /**
         * Magento Order Management property
         *
         * @access private
         *
         * @var \Magento\Sales\Api\OrderManagementInterface
         */
        private $_magentoOrderManagement;

        /**
         * Gets Magento Order Management
         *
         * @access protected
         *
         * @return \Magento\Sales\Api\OrderManagementInterface
         */
        protected function getMagentoOrderManagement() : MagentoOrderManagementInterface
        {
            return $this->_magentoOrderManagement;
        }
    }
?>