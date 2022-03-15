<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model;

    use Hippiemonkeys\SkroutzSmartCart\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterfaceFactory,
        Hippiemonkeys\SkroutzSmartCart\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\LineItemRejectionReason as ResourceModel;

    class LineItemRejectionReasonRepository
    implements LineItemRejectionReasonRepositoryInterface
    {
        protected
            $_localIdIndex      = [],
            $_skroutzIdIndex    = [];

        public function __construct(
            ResourceModel $resourceModel,
            LineItemRejectionReasonInterfaceFactory $lineItemRejectionReasonFactory
        )
        {
            $this->_resourceModel                   = $resourceModel;
            $this->_lineItemRejectionReasonFactory  = $lineItemRejectionReasonFactory;
        }

        /**
         * @inheritdoc
         */
        public function getByLocalId(int $localId) : LineItemRejectionReasonInterface
        {
            $lineItemRejectionReason = $this->_localIdIndex[$localId] ?? null;
            if(!$lineItemRejectionReason) {
                $lineItemRejectionReason = $this->getLineItemRejectionReasonFactory()->create();
                $this->getResourceModel()->load($lineItemRejectionReason, $localId, ResourceModel::FIELD_LOCAL_ID);
                $localId = $lineItemRejectionReason->getLocalId();
                if (!$localId)
                {
                    throw new NoSuchEntityException(
                        __('The Rejection Reason with id "%1" that was requested doesn\'t exist. Verify the Rejection Reason and try again.', $localId)
                    );
                }
                $this->_localIdIndex[$localId]                                      = $lineItemRejectionReason;
                $this->_skroutzIdIndex[ $lineItemRejectionReason->getSkroutzId() ]  = $lineItemRejectionReason;
            }
            return $lineItemRejectionReason;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(int $skroutzId) : LineItemRejectionReasonInterface
        {
            $lineItemRejectionReason = $this->_skroutzIdIndex[$skroutzId] ?? null;
            if(!$lineItemRejectionReason) {
                $lineItemRejectionReason = $this->getLineItemRejectionReasonFactory()->create();
                $this->getResourceModel()->load($lineItemRejectionReason, $localId, ResourceModel::FIELD_SKROUTZ_ID);
                $localId = $lineItemRejectionReason->getLocalId();
                if (!$localId)
                {
                    throw new NoSuchEntityException(
                        __('The Rejection Reason with id "%1" that was requested doesn\'t exist. Verify the Rejection Reason and try again.', $localId)
                    );
                }
                $this->_localIdIndex[$localId]      = $lineItemRejectionReason;
                $this->_skroutzIdIndex[$skroutzId]  = $lineItemRejectionReason;
            }
            return $lineItemRejectionReason;
        }

        /**
         * @inheritdoc
         */
        public function save(LineItemRejectionReasonInterface $lineItemRejectionReason) : LineItemRejectionReasonInterface
        {
            $this->getResourceModel()->save($lineItemRejectionReason);
            $this->_localIdIndex[ $lineItemRejectionReason->getLocalId() ]           = $lineItemRejectionReason;
            $this->_skroutzIdIndex[ $lineItemRejectionReason->getSkroutzId() ]  = $lineItemRejectionReason;
            return $lineItemRejectionReason;
        }

        /**
         * @inheritdoc
         */
        public function delete(LineItemRejectionReasonInterface $lineItemRejectionReason) : bool
        {
            $this->getResourceModel()->delete($lineItemRejectionReason);
            unset( $this->_localIdIndex[ $lineItemRejectionReason->getLocalId() ] );
            unset( $this->_skroutzIdIndex[ $lineItemRejectionReason->getSkroutzId() ] );
            return $lineItemRejectionReason->isDeleted();
        }

        private $_resourceModel;
        protected function getResourceModel(): ResourceModel
        {
            return $this->_resourceModel;
        }

        private $_lineItemRejectionReasonFactory;
        protected function getLineItemRejectionReasonFactory() : LineItemRejectionReasonInterfaceFactory
        {
            return $this->_lineItemRejectionReasonFactory;
        }
    }
?>