<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\AcceptOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptions as ResourceModel,
        Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException;

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