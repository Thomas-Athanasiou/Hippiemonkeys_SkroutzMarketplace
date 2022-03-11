<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    interface OrderInterface
    {
        const
            STATE_OPEN              = 'open',
            STATE_ACCEPTED          = 'accepted',
            STATE_REJECTED          = 'rejected',
            STATE_CANCELLED         = 'cancelled',
            STATE_EXPIRED           = 'expired',
            STATE_DISPATCHED        = 'dispatched',
            STATE_DELIVERED         = 'delivered',
            STATE_PARTIALY_RETURNED = 'partially_returned',
            STATE_RETURNED          = 'returned',
            STATE_FOR_RETURN        = 'for_return';

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
         * Get code
         *
         * @return string
         */
        function getCode(): string;

        /**
         * Set code
         *
         * @param string $code
         * @return $this
         */
        function setCode(string $code);

        /**
         * Get state
         *
         * @return string
         */
        function getState(): string;

        /**
         * Set state
         *
         * @param string $state
         * @return $this
         */
        function setState(string $state);

        /**
         * Get invoice
         *
         * @return bool
         */
        function getInvoice(): bool;

        /**
         * Set Invoice
         *
         * @param bool $invoice
         * @return $this
         */
        function setInvoice(bool $invoice);

        /**
         * Get created at
         *
         * @return string
         */
        function getCreatedAt(): string;
        /**
         * Get created at
         *
         * @param string $created_at
         * @return $this
         */
        function setCreatedAt(string $createdAt);

        /**
         * Get expires at
         *
         * @return string
         */
        function getExpiresAt(): string;

        /**
         * Get expires at
         *
         * @param string $expires_at
         * @return $this
         */
        function setExpiresAt(string $expiresAt);

        /**
         * Get dispatch untill
         *
         * @return string
         */
        function getDispatchUntil(): string;

        /**
         * Set dispatch untill
         *
         * @param string $dispatch_untill
         * @return $this
         */
        function setDispatchUntil(string $dispatchUntil);

        /**
         * Get courier tracking codes
         *
         * @return string[]
         */
        function getCourierTrackingCodes(): array;

        /**
         * Set courier tracking codes
         *
         * @param string[] $courierTrackingCodes
         * @return $this
         */
        function setCourierTrackingCodes(array $courierTrackingCodes);

        /**
         * Set line items
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterface[]
         */
        function getLineItems(): array;

        /**
         * Set courier
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterface[] $lineItems
         * @return $this
         */
        function setLineItems(array $lineItems);

        /**
         * Get comments
         * @return string
         */
        function getComments(): string;

        /**
         * Set comments
         * @param string $comment
         * @return $this
         */
        function setComments(string $comment);

        /**
         * Get customer
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface|null
         */
        function getCustomer();

        /**
         * Set customer
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface|null
         * @return $this
         */
        function setCustomer( $customer);

        /**
         * Get invoice details
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface|null
         */
        function getInvoiceDetails();

        /**
         * Set invoice details
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface|null $invoiceDetails
         * @return $this
         */
        function setInvoiceDetails($invoiceDetails);

        /**
         * Set courier
         * @return string
         */
        function getCourier(): string;

        /**
         * Set courier
         * @param string $courier
         * @return $this
         */
        function setCourier(string $courier);

        /**
         * Get courier voucher
         *
         * @return string|null
         */
        function getCourierVoucher();

        /**
         * Set courier voucher
         *
         * @param string|null $courierVoucher
         * @return $this
         */
        function setCourierVoucher($courierVoucher);

        /**
         * Get accept options
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface|null
         */
        function getAcceptOptions();

        /**
         * Set accept options
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface|null $acceptOptions
         * @return $this
         */
        function setAcceptOptions($acceptOptions);

        /**
         * Get reject options
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface|null
         */
        function getRejectOptions();

        /**
         * Set reject options
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface|null $rejectOptions
         * @return $this
         */
        function setRejectOptions($rejectOptions);

        /**
         * Get Magento Order
         *
         * @return \Magento\Sales\Api\Data\OrderInterface|null
         */
        function getMagentoOrder();

        /**
         * Set Magento Order
         *
         * @param \Magento\Sales\Api\Data\OrderInterface|null $magentoOrder
         * @return $this
         */
        function setMagentoOrder($magentoOrder);

        /**
         * Get express
         *
         * @return bool
         */
        function getExpress(): bool;

        /**
         * Set express
         *
         * @param bool $express
         * @return $this
         */
        function setExpress(bool $express);
    }
?>