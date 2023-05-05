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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\OrderProcessorInterface,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface;

    abstract class OrderProcessorAbstract
    implements OrderProcessorInterface
    {
        /**
         * Process order internaly
         *
         * @api
         * @access protected
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         */
        abstract protected function processOrderInternal(OrderInterface $order): void;

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config
         */
        public function __construct(
            LoggerInterface $logger,
            ConfigInterface $config
        )
        {
            $this->_logger = $logger;
            $this->_config = $config;
        }

        /**
         * {@inheritdoc}
         */
        public function processOrder(OrderInterface $order): void
        {
            if($this->getIsActive())
            {
                try
                {
                    $this->processOrderInternal($order);
                }
                catch (\Exception $exception)
                {
                    $this->getLogger()->error($exception->getMessage());
                }
            }
        }

        /**
         * Checks wether the management service can process any orders
         *
         * @access protected
         *
         * @return bool
         */
        protected function getIsActive(): bool
        {
            return $this->getConfig()->getIsActive();
        }

        /**
         * Config property
         *
         * @access private
         *
         * @var \Hippiemonkeys\Core\Api\Helper\ConfigInterface
         */
        private $_config;

        /**
         * Gets Config
         *
         * @access protected
         *
         * @return \Hippiemonkeys\Core\Api\Helper\ConfigInterface
         */
        protected function getConfig(): ConfigInterface
        {
            return $this->_config;
        }

        /**
         * Logger property
         *
         * @access private
         *
         * @var \Psr\Log\LoggerInterface
         */
        private $_logger;

        /**
         * Gets Logger
         *
         * @access protected
         *
         * @return \Psr\Log\LoggerInterface
         */
        protected function getLogger(): LoggerInterface
        {
            return $this->_logger;
        }
    }
?>