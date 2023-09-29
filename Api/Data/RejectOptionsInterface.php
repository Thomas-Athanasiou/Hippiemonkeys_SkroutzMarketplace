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

    namespace Hippiemonkeys\SkroutzMarketplace\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface;

    /**
     * @api
     */
    interface RejectOptionsInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @access public
         *
         * @param mixed $value
         *
         * @return mixed
         */
        function setId($id);

        /**
         * Get line item rejection reason
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface[]
         */
        function getLineItemRejectionReasons(): array;

        /**
         * Set line item rejection reason
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface[] $lineItemRejectionReasons
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface
         */
        function setLineItemRejectionReasons(array $lineItemRejectionReasons): RejectOptionsInterface;

        /**
         * Get Order
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function getOrder(): OrderInterface;

        /**
         * Set Order
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface
         */
        function setOrder(OrderInterface $order): RejectOptionsInterface;
    }
?>