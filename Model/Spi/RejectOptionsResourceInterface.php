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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface RejectOptionsResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_ORDER_ID = 'order_id';

        /**
         * Save RejectOptions data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface $rejectOptions
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsResourceInterface
         */
        function saveRejectOptions(RejectOptionsInterface $rejectOptions): RejectOptionsResourceInterface;

        /**
         * Load a RejectOptions by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface $rejectOptions
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsResourceInterface
         */
        function loadRejectOptionsById(RejectOptionsInterface $rejectOptions, $id): RejectOptionsResourceInterface;

        /**
         * Load a RejectOptions by Order Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface $rejectOptions
         * @param mixed $orderId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsResourceInterface
         */
        function loadRejectOptionsByOrderId(RejectOptionsInterface $rejectOptions, $orderId): RejectOptionsResourceInterface;

        /**
         * Delete the RejectOptions
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface $rejectOptions
         *
         * @return bool
         */
        function deleteRejectOptions(RejectOptionsInterface $rejectOptions): bool;
    }
?>