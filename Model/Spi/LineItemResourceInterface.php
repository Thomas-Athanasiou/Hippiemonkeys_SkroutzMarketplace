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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Line Item Resource interface
     */
    interface LineItemResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_SKROUTZ_ID = 'skroutz_id',
            FIELD_SIZE = 'size',
            FIELD_SHOPUID = 'shopuid',
            FIELD_PRODUCT_NAME = 'product_name',
            FIELD_QUANTITY = 'quantity',
            FIELD_UNIT_PRICE = 'unit_price',
            FIELD_TOTAL_PRICE = 'total_price',
            FIELD_PRICE_INCLUDES_VAT = 'price_includes_vat',
            FIELD_EAN = 'ean',
            FIELD_ISLAND_VAT_DISCOUNT_APPLIED = 'island_vat_discount_applied',
            FIELD_EXTRA_INFO = 'extra_info',
            FIELD_ORDER_ID = 'order_id',
            FIELD_REJECTION_REASON = 'rejection_reason',
            FIELD_RETURN_REASON = 'return_reason',
            FIELD_SERIAL_NUMBERS = 'serial_numbers',
            FIELD_SHOP_VARIATION_UID = 'shop_variation_uid';

        /**
         * Saves Line Item data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface $lineItem
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemResourceInterface
         */
        function saveLineItem(LineItemInterface $lineItem): LineItemResourceInterface;

        /**
         * Load a Line Item by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface $lineItem
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemResourceInterface
         */
        function loadLineItemById(LineItemInterface $lineItem, $id): LineItemResourceInterface;

        /**
         * Load a Line Item by Skroutz Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface $lineItem
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemResourceInterface
         */
        function loadLineItemBySkroutzId(LineItemInterface $lineItem, string $skroutzId): LineItemResourceInterface;

        /**
         * Deletes the Line Item
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface $lineItem
         *
         * @return bool
         */
        function deleteLineItem(LineItemInterface $LineItem): bool;
    }
?>