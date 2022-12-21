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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface LineItemRejectionReasonResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_SKROUTZ_ID = 'id',
            FIELD_LABEL = 'label',
            FIELD_REQUIRES_AVAILABILITY_QUANTITY = 'requires_available_quantity';

        /**
         * Save LineItemRejectionReason data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface $lineItemRejectionReason
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonResourceInterface
         */
        function saveLineItemRejectionReason(LineItemRejectionReasonInterface $lineItemRejectionReason): LineItemRejectionReasonResourceInterface;

        /**
         * Load a LineItemRejectionReason by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface $lineItemRejectionReason
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonResourceInterface
         */
        function loadLineItemRejectionReasonById(LineItemRejectionReasonInterface $lineItemRejectionReason, $id): LineItemRejectionReasonResourceInterface;

        /**
         * Delete the LineItemRejectionReason
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface $lineItemRejectionReason
         *
         * @return bool
         */
        function deleteLineItemRejectionReason(LineItemRejectionReasonInterface $lineItemRejectionReason): bool;
    }
?>