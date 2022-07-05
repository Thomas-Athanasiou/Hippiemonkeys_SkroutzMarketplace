<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface RejectOptionsLineItemRejectionReasonRelationInterface
    {
        /**
         * Gets ID
         *
         * @return mixed.
         */
        function getId();

        /**
         * Sets ID
         *
         * @param mixed $value
         * @return $this
         */
        function setId($id);

        /**
         * Gets Reject Options
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface.
         */
        function getRejectOptions(): RejectOptionsInterface;

        /**
         * Sets Reject Options
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface $value
         * @return $this
         */
        function setRejectOptions(RejectOptionsInterface  $rejectOptions);

        /**
         * Gets Line Item Rejection Reason
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface.
         */
        function getLineItemRejectionReason(): LineItemRejectionReasonInterface;

        /**
         * Sets Line Item Rejection Reason
         *
         * @param Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface $value
         * @return $this
         */
        function setLineItemRejectionReason(LineItemRejectionReasonInterface $lineItemRejectionReason);
    }
?>