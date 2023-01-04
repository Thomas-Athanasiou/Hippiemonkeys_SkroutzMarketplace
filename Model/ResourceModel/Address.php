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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AddressInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AddressResourceInterface;

    class Address
    extends AbstractResource
    implements AddressResourceInterface
    {
        protected const
            TABLE_MAIN = 'hippiemonkeys_skroutzmarketplace_address';

        /**
         * {@inheritdoc}
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function saveAddress(AddressInterface $address): AddressResourceInterface
        {
            return $this->saveModel($address);
        }

        /**
         * {@inheritdoc}
         */
        function loadAddressById(AddressInterface $address, $id): AddressResourceInterface
        {
            return $this->loadModelById($address, $id);
        }

        /**
         * {@inheritdoc}
         */
        function deleteAddress(AddressInterface $address): bool
        {
            return $this->deleteModel($address);
        }
    }
?>