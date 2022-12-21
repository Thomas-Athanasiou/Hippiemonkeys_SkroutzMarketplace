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
    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\AcceptOptions as ResourceModel,
        Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException;

    class AcceptOptionsRepository
    implements AcceptOptionsRepositoryInterface
    {
        protected
            $_idIndex       = [],
            $_orderIdIndex  = [];

        public function __construct(
            ResourceModel $resourceModel,
            AcceptOptionsInterfaceFactory $acceptOptionsFactory
        )
        {
            $this->_resourceModel           = $resourceModel;
            $this->_acceptOptionsFactory    = $acceptOptionsFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById($id) : AcceptOptionsInterface
        {
            $acceptOptions = $this->_idIndex[$id] ?? null;
            if(!$acceptOptions) {
                $acceptOptions = $this->getAcceptOptionsFactory()->create();
                $this->getResourceModel()->load($acceptOptions, $id, ResourceModel::FIELD_ID);
                if (!$acceptOptions->getId())
                {
                    throw new NoSuchEntityException(
                        __('The accept options with id "%1" that was requested doesn\'t exist. Verify the accept options and try again.', $id)
                    );
                }
                $orderId = $acceptOptions->getOrder()->getId();
                $this->_orderIdIndex[$orderId]  = $acceptOptions;
                $this->_idIndex[$id]            = $acceptOptions;
            }
            return $acceptOptions;
        }
        /**
         * @inheritdoc
         */
        public function getByOrder(OrderInterface $order) : AcceptOptionsInterface
        {
            $orderId = $order->getId();
            $acceptOptions = $this->_orderIdIndex[$orderId] ?? null;
            if(!$acceptOptions) {
                $acceptOptions = $this->getAcceptOptionsFactory()->create();
                $this->getResourceModel()->load($acceptOptions, $orderId, ResourceModel::FIELD_ORDER_ID);
                $id = $acceptOptions->getId();
                if (!$id)
                {
                    throw new NoSuchEntityException(
                        __('The accept options with order id "%1" that was requested doesn\'t exist. Verify the accept options and try again.', $orderId)
                    );
                }
                $this->_orderIdIndex[$orderId]  = $acceptOptions;
                $this->_idIndex[$id]            = $acceptOptions;
            }
            return $acceptOptions;
        }

        /**
         * @inheritdoc
         */
        public function save(AcceptOptionsInterface $acceptOptions) : AcceptOptionsInterface
        {
            $this->getResourceModel()->save($acceptOptions);
            $this->_idIndex[ $acceptOptions->getId() ] = $acceptOptions;
            return $acceptOptions;
        }

        /**
         * @inheritdoc
         */
        public function delete(AcceptOptionsInterface $acceptOptions) : bool
        {
            $this->getResourceModel()->delete($acceptOptions);
            unset( $this->_orderIdIndex[ $acceptOptions->getOrder()->getId() ] );
            unset( $this->_idIndex[ $acceptOptions->getId() ] );
            return $acceptOptions->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_acceptOptionsFactory;
        protected function getAcceptOptionsFactory() : AcceptOptionsInterfaceFactory
        {
            return $this->_acceptOptionsFactory;
        }
    }
?>