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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface AcceptOptionsResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_ORDER_ID = 'order_id',
            FIELD_NUMBER_OF_PARCELS = 'number_of_parcels';

        /**
         * Save Accept Options data
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface $acceptOptions
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsResourceInterface
         */
        function saveAcceptOptions(AcceptOptionsInterface $acceptOptions): AcceptOptionsResourceInterface;

        /**
         * Load a Accept Options by Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface $acceptOptions
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsResourceInterface
         */
        function loadAcceptOptionsById(AcceptOptionsInterface $acceptOptions, $id): AcceptOptionsResourceInterface;

        /**
         * Load a Accept Options by Order Id
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface $acceptOptions
         * @param mixed $orderId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsResourceInterface
         */
        function loadAcceptOptionsByOrderId(AcceptOptionsInterface $acceptOptions, $orderId): AcceptOptionsResourceInterface;

        /**
         * Delete the Accept Options
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface $acceptOptions
         *
         * @return bool
         */
        function deleteAcceptOptions(AcceptOptionsInterface $AcceptOptions): bool;
    }
?>