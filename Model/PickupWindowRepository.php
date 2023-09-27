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

    use Magento\Framework\Exception\NoSuchEntityException,
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
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface[] $idCache
             */
            $idCache = [],

            /**
             * Skroutz Id Cache property
             *
             * @access protected
             *
             * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterface[] $skroutzIdCache
             */
            $skroutzIdCache = [];

        public function __construct(
            ResourceInterface $resource,
            PickupWindowInterfaceFactory $factory
        )
        {
            $this->resource = $resource;
            $this->factory = $factory;
        }

        /**
         * @inheritdoc
         */
        public function getById(int $id) : PickupWindowInterface
        {
            $pickupWindow = $this->idCache[$id] ?? null;
            if($pickupWindow === null)
            {
                $pickupWindow = $this->getFactory()->create();
                $this->getResource()->loadPickupWindowById($pickupWindow, $id, ResourceInterface::FIELD_ID);
                if ($pickupWindow->getId() === null)
                {
                    throw new NoSuchEntityException(
                        __('The Pickup Window with id "%1" that was requested doesn\'t exist. Verify the Pickup Window and try again.', $id)
                    );
                }
                else
                {
                    $this->idCache[$id] = $pickupWindow;
                    $this->skroutzIdCache[$pickupWindow->getBySkroutzId()] = $pickupWindow;
                }
            }

            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function getBySkroutzId(int $skroutzId) : PickupWindowInterface
        {
            $pickupWindow = $this->skroutzIdCache[$skroutzId] ?? null;
            if($pickupWindow === null)
            {
                $pickupWindow = $this->getFactory()->create();
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
                    $this->idCache[$id] = $pickupWindow;
                    $this->skroutzIdCache[$skroutzId] = $pickupWindow;
                }
            }
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function save(PickupWindowInterface $pickupWindow) : PickupWindowInterface
        {
            $this->getResource()->savePickupWindow($pickupWindow);
            $this->skroutzIdCache[$pickupWindow->getSkroutzId()] = $pickupWindow;
            $this->idCache[$pickupWindow->getId()] = $pickupWindow;
            return $pickupWindow;
        }

        /**
         * @inheritdoc
         */
        public function delete(PickupWindowInterface $pickupWindow) : bool
        {
            unset($this->idCache[$pickupWindow->getId()]);
            unset($this->skroutzIdCache[$pickupWindow->getSkroutzId()]);
            return $this->getResource()->deletePickupWindow($pickupWindow);
        }

        /**
         * Resource property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupWindowResourceInterface $resource
         */
        private $resource;

        /**
         * Gets Resource
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Model\Spi\PickupWindowResourceInterface
         */
        protected function getResource(): ResourceInterface
        {
            return $this->resource;
        }

        /**
         * Pickup Window Factory property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterfaceFactory $factory
         */
        private $factory;

        /**
         * Gets Pickup Window Factory
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupWindowInterfaceFactory
         */
        protected function getFactory() : PickupWindowInterfaceFactory
        {
            return $this->factory;
        }
    }
?>