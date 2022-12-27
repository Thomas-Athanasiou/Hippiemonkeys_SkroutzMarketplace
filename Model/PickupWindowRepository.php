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

    use Hippiemonkeys\SkroutzMarketplace\Exception\NoSuchEntityException,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterfaceFactory,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupWindowRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupWindowResourceInterface as ResourceInterface;

    class PickupWindowRepository
    implements PickupWindowRepositoryInterface
    {
        protected
            /**
             * Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface[] $_idCache
             */
            $_idCache = [],

            /**
             * Skroutz Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface[] $_skroutzIdCache
             */
            $_skroutzIdCache = [];

        public function __construct(
            ResourceInterface $resource,
            PickupWindowInterfaceFactory $pickupWindowFactory
        )
        {
            $this->_resource = $resource;
            $this->_pickupWindowFactory = $pickupWindowFactory;
        }

        /**
         * {@inheritdoc}
         */
        public function getById(int $id) : PickupWindowInterface
        {
            $pickupWindow = $this->_idCache[$id] ?? null;
            if($pickupWindow === null)
            {
                $pickupWindow = $this->getPickupWindowFactory()->create();
                $this->getResource()->loadPickupWindowById($pickupWindow, $id, ResourceInterface::FIELD_ID);
                if ($pickupWindow->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Window with id "%1" that was requested doesn\'t exist. Verify the Pickup Window and try again.', $id)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $pickupWindow;
                    $this->_skroutzIdCache[$pickupWindow->getBySkroutzId()] = $pickupWindow;
                }
            }

            return $pickupWindow;
        }

        /**
         * {@inheritdoc}
         */
        public function getBySkroutzId(int $skroutzId) : PickupWindowInterface
        {
            $pickupWindow = $this->_skroutzIdCache[$skroutzId] ?? null;
            if($pickupWindow === null)
            {
                $pickupWindow = $this->getPickupWindowFactory()->create();
                $this->getResource()->loadPickupWindowBySkroutzId($pickupWindow, $skroutzId);
                $id = $pickupWindow->getId();
                if ($id === null)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Window with skroutz id "%1" that was requested doesn\'t exist. Verify the pickupWindow and try again.', $skroutzId)
                    );
                }
                else
                {
                    $this->_idCache[$id] = $pickupWindow;
                    $this->_skroutzIdCache[$skroutzId] = $pickupWindow;
                }
            }
            return $pickupWindow;
        }

        /**
         * {@inheritdoc}
         */
        public function save(PickupWindowInterface $pickupWindow) : PickupWindowInterface
        {
            $this->getResource()->savePickupWindow($pickupWindow);
            $this->_skroutzIdCache[$pickupWindow->getSkroutzId()] = $pickupWindow;
            $this->_idCache[$pickupWindow->getId()] = $pickupWindow;
            return $pickupWindow;
        }

        /**
         * {@inheritdoc}
         */
        public function delete(PickupWindowInterface $pickupWindow) : bool
        {
            unset($this->_idCache[$pickupWindow->getId()]);
            unset($this->_skroutzIdCache[$pickupWindow->getSkroutzId()]);
            return $this->getResource()->deletePickupWindow($pickupWindow);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupWindowResourceInterface $_resource
         */
        private $_resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupWindowResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->_resource;
        }

        /**
         * Pickup Window Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterfaceFactory $_pickupWindowFactory
         */
        private $_pickupWindowFactory;

        /**
         * Gets Pickup Window Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterfaceFactory
         */
        protected function getPickupWindowFactory() : PickupWindowInterfaceFactory
        {
            return $this->_pickupWindowFactory;
        }
    }
?>