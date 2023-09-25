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

    use Exception,
        Magento\Framework\Webapi\ServiceInputProcessor,
        Magento\Framework\HTTP\Client\Curl,
        Magento\Framework\Serialize\Serializer\Json as JsonSerializer,
        Hippiemonkeys\Core\Api\Helper\ConfigInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\OrderManagementInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface,
        Hippiemonkeys\SkroutzMarketplace\Exception\ServiceException;

    class SkroutzMarketplace
    implements SkroutzMarketplaceInterface
    {
        protected const
            CONF_PATH_API_HOST = 'api_host',
            CONF_PATH_API_TOKEN = 'api_token',

            TOKEN_FORMAT = 'Bearer %s',

            GET_ORDER_PATH_FORMAT = '%s/merchants/ecommerce/orders/%s',

            ACCEPT_OPTIONS_PATH_FORMAT = '%s/merchants/ecommerce/orders/%s/accept',
            ACCEPT_OPTIONS_BODY_FORMAT = '{ "pickup_location": "%s", "pickup_window": %d, "number_of_parcels": %d }';

        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config
         * @param \Magento\Framework\HTTP\Client\Curl $httpClient
         * @param \Magento\Framework\Webapi\ServiceInputProcessor $serviceInputProcessor
         * @param \Magento\Framework\Serialize\Serializer\Json $jsonSerializer
         */
        public function __construct(
            ConfigInterface $config,
            Curl $httpClient,
            ServiceInputProcessor $serviceInputProcessor,
            JsonSerializer $jsonSerializer
        )
        {
            $this->config = $config;
            $this->httpClient = $httpClient;
            $this->serviceInputProcessor = $serviceInputProcessor;
            $this->jsonSerializer = $jsonSerializer;

            $httpClient->addHeader('Accept', 'application/vnd.skroutz+json; version=3.0');
            $httpClient->addHeader('Content-Type', 'application/json; charset=utf-8');
            $httpClient->addHeader('Authorization',  sprintf(self::TOKEN_FORMAT, $this->getApiToken()));
        }

        /**
         * @inheritdoc
         * @todo Response
         */
        public function acceptOrder(OrderInterface $order, int $numberOfParcels, PickupLocationInterface $pickupLocation, PickupWindowInterface $pickupWindow): object
        {
            $httpClient = $this->getHttpClient();
            $httpClient->post(
                \sprintf(self::ACCEPT_OPTIONS_PATH_FORMAT, $this->getApiHost(), $order->getCode()),
                \sprintf(self::ACCEPT_OPTIONS_BODY_FORMAT, $pickupLocation->getSkroutzId(), $pickupWindow->getSkroutzId(), $numberOfParcels),
            );

            $response = \json_decode($httpClient->getBody(), false, 512, 0);

            $errors = $response->errors ?? [];
            if(count($errors) > 0)
            {
                throw new ServiceException(
                    __(
                        implode(
                            '. ',
                            array_map(
                                function (object $error): string
                                {
                                    return implode(', ', $error->messages);
                                },
                                $errors
                            )
                        )
                    )
                );
            }

            return is_object($response) ? $response : new \stdClass();
        }

        /**
         * @inheritdoc
         */
        public function getOrder(string $code): ?OrderInterface
        {
            $order = null;

            try
            {
                $httpClient = $this->getHttpClient();
                $httpClient->get(sprintf(self::GET_ORDER_PATH_FORMAT, $this->getApiHost(), $code), []);

                $orderData = $this->getServiceInputProcessor()->process(
                    OrderManagementInterface::class,
                    'processOrder',
                    $this->getJsonSerializer()->unserialize(
                        $httpClient->getBody()
                    )
                );

                if($orderData instanceof OrderInterface)
                {
                    $order = $orderData;
                }
            }
            catch (Exception)
            {

            }

            return $order;
        }

        /**
         * Gets Api Host
         *
         * @access protected
         * @final
         *
         * @return string
         */
        protected final function getApiHost(): string
        {
            return rtrim($this->getConfig()->getData(self::CONF_PATH_API_HOST), '/');
        }

        /**
         * Gets Api Token
         *
         * @access protected
         * @final
         *
         * @return string
         */
        protected final function getApiToken(): string
        {
            return $this->getConfig()->getData(self::CONF_PATH_API_TOKEN);
        }

        /**
         * Config property
         *
         * @access private
         *
         * @var \Hippiemonkeys\Core\Api\Helper\ConfigInterface $config
         */
        private $config;

        /**
         * Gets Config
         *
         * @access protected
         *
         * @return \Hippiemonkeys\Core\Api\Helper\ConfigInterface
         */
        protected function getConfig(): ConfigInterface
        {
            return $this->config;
        }

        /**
         * Config property
         *
         * @access private
         *
         * @var \Magento\Framework\HTTP\Client\Curl $httpClient
         */
        private $httpClient;

        /**
         * Gets Config
         *
         * @access protected
         * @final
         *
         * @return \Magento\Framework\HTTP\Client\Curl
         */
        protected final function getHttpClient(): Curl
        {
            return $this->httpClient;
        }

        /**
         * Service Payload Converter property
         *
         * @access private
         *
         * @var \Magento\Framework\Webapi\ServiceInputProcessor $serviceInputProcessor
         */
        private $serviceInputProcessor;

        /**
         * Gets Service Payload Converter
         *
         * @access protected
         * @final
         *
         * @return \Magento\Framework\Webapi\ServiceInputProcessor
         */
        protected final function getServiceInputProcessor(): ServiceInputProcessor
        {
            return $this->serviceInputProcessor;
        }

        /**
         * Json Serializer property
         *
         * @access private
         *
         * @var \Magento\Framework\Serialize\Serializer\Json $jsonSerializer
         */
        private $jsonSerializer;

        /**
         * Gets Json Serializer
         *
         * @access protected
         * @final
         *
         * @return \Magento\Framework\Serialize\Serializer\Json
         */
        protected final function getJsonSerializer(): JsonSerializer
        {
            return $this->jsonSerializer;
        }
    }
?>
