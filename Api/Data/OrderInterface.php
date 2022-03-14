<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
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
         * @return \this
         */
        function setId($id);

        /**
         * Gets code
         *
         * @return string
         */
        function getCode(): string;

        /**
         * Sets code
         *
         * @param string $code
         * @return \this
         */
        function setCode(string $code);

        /**
         * Gets state
         *
         * @return string
         */
        function getState(): string;

        /**
         * Sets state
         *
         * @param string $state
         * @return \this
         */
        function setState(string $state);

        /**
         * Gets invoice
         *
         * @return bool
         */
        function getInvoice(): bool;

        /**
         * Sets Invoice
         *
         * @param bool $invoice
         * @return \this
         */
        function setInvoice(bool $invoice);

        /**
         * Gets created at
         *
         * @return string
         */
        function getCreatedAt(): string;
        /**
         * Gets created at
         *
         * @param string $created_at
         * @return \this
         */
        function setCreatedAt(string $createdAt);

        /**
         * Gets expires at
         *
         * @return string
         */
        function getExpiresAt(): string;

        /**
         * Gets expires at
         *
         * @param string $expires_at
         * @return \this
         */
        function setExpiresAt(string $expiresAt);

        /**
         * Gets dispatch untill
         *
         * @return string
         */
        function getDispatchUntil(): string;

        /**
         * Sets dispatch untill
         *
         * @param string $dispatch_untill
         * @return \this
         */
        function setDispatchUntil(string $dispatchUntil);

        /**
         * Gets courier tracking codes
         *
         * @return string[]
         */
        function getCourierTrackingCodes(): array;

        /**
         * Sets courier tracking codes
         *
         * @param string[] $courierTrackingCodes
         * @return \this
         */
        function setCourierTrackingCodes(array $courierTrackingCodes);

        /**
         * Sets line items
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterface[]
         */
        function getLineItems(): array;

        /**
         * Sets courier
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemInterface[] $lineItems
         * @return \this
         */
        function setLineItems(array $lineItems);

        /**
         * Gets comments
         * @return string
         */
        function getComments(): string;

        /**
         * Sets comments
         * @param string $comment
         * @return \this
         */
        function setComments(string $comment);

        /**
         * Gets customer
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface|null
         */
        function getCustomer();

        /**
         * Sets customer
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\CustomerInterface|null
         * @return \this
         */
        function setCustomer( $customer);

        /**
         * Gets invoice details
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface|null
         */
        function getInvoiceDetails();

        /**
         * Sets invoice details
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\InvoiceDetailsInterface|null $invoiceDetails
         * @return \this
         */
        function setInvoiceDetails($invoiceDetails);

        /**
         * Sets courier
         * @return string
         */
        function getCourier(): string;

        /**
         * Sets courier
         * @param string $courier
         * @return \this
         */
        function setCourier(string $courier);

        /**
         * Gets courier voucher
         *
         * @return string|null
         */
        function getCourierVoucher();

        /**
         * Sets courier voucher
         *
         * @param string|null $courierVoucher
         * @return \this
         */
        function setCourierVoucher($courierVoucher);

        /**
         * Gets accept options
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface|null
         */
        function getAcceptOptions();

        /**
         * Sets accept options
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsInterface|null $acceptOptions
         * @return \this
         */
        function setAcceptOptions($acceptOptions);

        /**
         * Gets reject options
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface|null
         */
        function getRejectOptions();

        /**
         * Sets reject options
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface|null $rejectOptions
         * @return \this
         */
        function setRejectOptions($rejectOptions);

        /**
         * Gets Magento Order
         *
         * @return \Magento\Sales\Api\Data\OrderInterface|null
         */
        function getMagentoOrder();

        /**
         * Sets Magento Order
         *
         * @param \Magento\Sales\Api\Data\OrderInterface|null $magentoOrder
         * @return \this
         */
        function setMagentoOrder($magentoOrder);

        /**
         * Gets Express
         *
         * @return bool
         */
        function getExpress(): bool;

        /**
         * Sets Express
         *
         * @param bool $express
         * @return \this
         */
        function setExpress(bool $express);

        /**
         * Gets Custom
         *
         * @return bool
         */
        function getCustom(): bool;

        /**
         * Sets Custom
         *
         * @param bool $custom
         *
         * @return \this
         */
        function setCustom(bool $custom);
    }
?>