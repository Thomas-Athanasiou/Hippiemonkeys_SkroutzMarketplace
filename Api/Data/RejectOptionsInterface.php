<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface RejectOptionsInterface
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
         * Get line item rejection reason
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface[]
         */
        function getLineItemRejectionReasons(): array;

        /**
         * Set line item rejection reason
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface[] $lineItemRejectionReasons
         * @return $this
         */
        function setLineItemRejectionReasons(array $lineItemRejectionReasons);

        /**
         * Get Order
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface
         */
        function getOrder(): OrderInterface;

        /**
         * Set Order
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface $order
         * @return $this
         */
        function setOrder(OrderInterface $order);
    }
?>