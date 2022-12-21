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

    use Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\RejectOptionsRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\RejectOptions as ResourceModel;

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
        public function getById($id) : RejectOptionsInterface
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