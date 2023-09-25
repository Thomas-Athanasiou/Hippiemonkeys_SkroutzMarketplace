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

    interface RejectOptionsLineItemRejectionReasonRelationInterface
    extends ModelInterface
    {
        /**
         * Sets ID
         *
         * @api
         * @access public
         *
         * @param mixed $value
         *
         * @return mixed
         */
        function setId($id);

        /**
         * Gets Reject Options
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface
         */
        function getRejectOptions(): RejectOptionsInterface;

        /**
         * Sets Reject Options
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface $value
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface
         */
        function setRejectOptions(RejectOptionsInterface  $rejectOptions);

        /**
         * Gets Line Item Rejection Reason
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface
         */
        function getLineItemRejectionReason(): LineItemRejectionReasonInterface;

        /**
         * Sets Line Item Rejection Reason
         *
         * @api
         * @access public
         *
         * @param Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface $value
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface
         */
        function setLineItemRejectionReason(LineItemRejectionReasonInterface $lineItemRejectionReason);
    }
?>