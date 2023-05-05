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

    use Psr\Log\LoggerInterface,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface;

    class OrderProcessorComposite
    extends OrderProcessorAbstract
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config
         * @param \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderProcessorInterface[] $orderProcessor
         */
        public function __construct(
            LoggerInterface $logger,
            ConfigInterface $config,
            array $orderProcessors
        )
        {
            parent::__construct($logger, $config);
            $this->_orderProcessors = $orderProcessors;
        }

        /**
         * {@inheritdoc}
         */
        protected function processOrderInternal(OrderInterface $order): void
        {
            $logger = $this->getLogger();
            foreach ($this->getOrderProcessors() as $orderProcessor)
            {
                try
                {
                    $orderProcessor->processOrder($order);
                }
                catch (\Exception $exception)
                {
                    $logger->error($exception->getMessage());
                }
            }
        }

        /**
         * Order Processors property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderProcessorInterface[]
         */
        private $_orderProcessors;

        /**
         * Order Processors
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderProcessorInterface[]
         */
        protected function getOrderProcessors(): array
        {
            return $this->_orderProcessors;
        }
    }
?>