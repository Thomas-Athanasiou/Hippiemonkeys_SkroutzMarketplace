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

    use Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\LineItemRejectionReasonRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemRejectionReasonResourceInterface as ResourceInterface;

    class LineItemRejectionReasonRepository
    implements LineItemRejectionReasonRepositoryInterface
    {
        protected
            $_idCache = [],
            $_skroutzIdCache = [];

        public function __construct(
            ResourceInterface $resource,
            LineItemRejectionReasonInterfaceFactory $lineItemRejectionReasonFactory
        )
        {
            $this->_resource = $resource;
            $this->_lineItemRejectionReasonFactory = $lineItemRejectionReasonFactory;
        }

        /**
         * {@inheritdoc}
         */
        public function getById($id) : LineItemRejectionReasonInterface
        {
            $lineItemRejectionReason = $this->_idCache[$id] ?? null;
            if($lineItemRejectionReason === null)
            {
                $lineItemRejectionReason = $this->getLineItemRejectionReasonFactory()->create();
                $this->getResource()->loadLineItemRejectionReasonById($lineItemRejectionReason, $id);
                if ($lineItemRejectionReason->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Line Item Rejection Reason with id "%1" that was requested doesn\'t exist. Verify the Line Item Rejection Reason and try again.', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $lineItemRejectionReason;
                    $this->_skroutzIdCache[$lineItemRejectionReason->getSkroutzId()]  = $lineItemRejectionReason;
                }
            }
            return $lineItemRejectionReason;
        }

        /**
         * {@inheritdoc}
         */
        public function getBySkroutzId(int $skroutzId) : LineItemRejectionReasonInterface
        {
            $lineItemRejectionReason = $this->_skroutzIdCache[$skroutzId] ?? null;
            if($lineItemRejectionReason === null)
            {
                $lineItemRejectionReason = $this->getLineItemRejectionReasonFactory()->create();
                $this->getResource()->loadLineItemRejectionReasonBySkroutzId($lineItemRejectionReason, $skroutzId);
                $id = $lineItemRejectionReason->getId();
                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Line Item Rejection Reason with Skroutz Id "%0" that was requested doesn\'t exist. Verify the Line Item Rejection Reason and try again.', $skroutzId)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $lineItemRejectionReason;
                    $this->_skroutzIdCache[$skroutzId] = $lineItemRejectionReason;
                }
            }
            return $lineItemRejectionReason;
        }

        /**
         * {@inheritdoc}
         */
        public function save(LineItemRejectionReasonInterface $lineItemRejectionReason) : LineItemRejectionReasonInterface
        {
            $this->_idCache[$lineItemRejectionReason->getId()] = $lineItemRejectionReason;
            $this->_skroutzIdCache[$lineItemRejectionReason->getSkroutzId()]  = $lineItemRejectionReason;
            $this->getResource()->saveLineItemRejectionReason($lineItemRejectionReason);
            return $lineItemRejectionReason;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(LineItemRejectionReasonInterface $lineItemRejectionReason) : bool
        {
            unset($this->_idCache[$lineItemRejectionReason->getId()]);
            unset($this->_skroutzIdCache[$lineItemRejectionReason->getSkroutzId()]);
            return $this->getResource()->deleteLineItemRejectionReason($lineItemRejectionReason);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemRejectionReasonResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\LineItemRejectionReasonResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Line Item Rejection Reason Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterfaceFactory $_lineItemRejectionReasonFactory
         */
        private $_lineItemRejectionReasonFactory;

        /**
         * Gets Line Item Rejection Reason Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterfaceFactory
         */
        protected function getLineItemRejectionReasonFactory() : LineItemRejectionReasonInterfaceFactory
        {
            return $this->_lineItemRejectionReasonFactory;
        }
    }
?>