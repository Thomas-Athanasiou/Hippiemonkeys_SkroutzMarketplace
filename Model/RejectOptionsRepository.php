<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */
    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\RejectOptions as ResourceModel;

    class RejectOptionsRepository
    implements RejectOptionsRepositoryInterface
    {
        protected
            $_idIndex       = [],
            $_orderIdIndex  = [];

        public function __construct(
            ResourceModel $resourceModel,
            RejectOptionsInterfaceFactory $rejectOptionsFactory
        )
        {
            $this->_resourceModel           = $resourceModel;
            $this->_rejectOptionsFactory    = $rejectOptionsFactory;
        }

        /**
         * @inheritdoc
         */
        public function getById(int $id) : RejectOptionsInterface
        {
            $rejectOptions = $this->_idIndex[$id] ?? null;
            if(!$rejectOptions) {
                $rejectOptions = $this->getRejectOptionsFactory()->create();
                $this->getResourceModel()->load($rejectOptions, $id, ResourceModel::FIELD_ID);
                if (!$rejectOptions->getId())
                {
                    throw new NoSuchEntityException(
                        __('The reject options with id "%1" that was requested doesn\'t exist. Verify the reject options and try again.', $id)
                    );
                }
                $this->_orderIdIndex[ $rejectOptions->getOrder()->getId() ] = $rejectOptions;
                $this->_idIndex[$id]                                        = $rejectOptions;
            }
            return $rejectOptions;
        }

        /**
         * @inheritdoc
         */
        public function getByOrder(OrderInterface $order) : RejectOptionsInterface
        {
            $orderId = $order->getId();
            $rejectOptions = $this->_orderIdIndex[$orderId] ?? null;
            if(!$rejectOptions) {
                $rejectOptions = $this->getRejectOptionsFactory()->create();
                $this->getResourceModel()->load($rejectOptions, $orderId, ResourceModel::FIELD_ORDER_ID);
                $id = $rejectOptions->getId();
                if (!$id)
                {
                    throw new NoSuchEntityException(
                        __('The reject options with order id "%1" that was requested doesn\'t exist. Verify the reject options and try again.', $orderId)
                    );
                }
                $this->_orderIdIndex[$orderId]  = $rejectOptions;
                $this->_idIndex[$id]            = $rejectOptions;
            }
            return $rejectOptions;
        }

        /**
         * @inheritdoc
         */
        public function save(RejectOptionsInterface $rejectOptions) : RejectOptionsInterface
        {
            $rejectOptions->getResource()->save($rejectOptions);
            $this->_idIndex[ $rejectOptions->getId() ] = $rejectOptions;
            $this->_orderIdIndex[ $rejectOptions->getOrder()->getId() ] = $rejectOptions;
            return $rejectOptions;
        }

        /**
         * @inheritdoc
         */
        public function delete(RejectOptionsInterface $rejectOptions) : bool
        {
            $rejectOptions->getResource()->delete($rejectOptions);
            unset( $this->_idIndex[ $rejectOptions->getId() ] );
            unset( $this->_orderIdIndex[ $rejectOptions->getOrder()->getId() ] );
            return $rejectOptions->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_rejectOptionsFactory;
        protected function getRejectOptionsFactory() : RejectOptionsInterfaceFactory
        {
            return $this->_rejectOptionsFactory;
        }
    }
?>