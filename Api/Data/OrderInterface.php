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

    namespace Hippiemonkeys\SkroutzMarketplace\Api\Data;

    use Hippiemonkeys\Core\Api\Data\ModelInterface,
        Magento\Sales\Api\Data\OrderInterface as MagentoOrderInterface;

    interface OrderInterface
    extends ModelInterface
    {
        const
            STATE_OPEN = 'open',
            STATE_ACCEPTED = 'accepted',
            STATE_REJECTED = 'rejected',
            STATE_CANCELLED = 'cancelled',
            STATE_EXPIRED = 'expired',
            STATE_DISPATCHED = 'dispatched',
            STATE_DELIVERED = 'delivered',
            STATE_PARTIALY_RETURNED = 'partially_returned',
            STATE_RETURNED = 'returned',
            STATE_FOR_RETURN = 'for_return';

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
         * Gets code
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getCode(): string;

        /**
         * Sets code
         *
         * @api
         * @access public
         *
         * @param string $code
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setCode(string $code): OrderInterface;

        /**
         * Gets state
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getState(): string;

        /**
         * Sets state
         *
         * @api
         * @access public
         *
         * @param string $state
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setState(string $state): OrderInterface;

        /**
         * Gets invoice
         *
         * @api
         * @access public
         *
         * @return bool
         */
        function getInvoice(): bool;

        /**
         * Sets Invoice
         *
         * @api
         * @access public
         *
         * @param bool $invoice
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setInvoice(bool $invoice): OrderInterface;

        /**
         * Gets created at
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getCreatedAt(): string;

        /**
         * Gets created at
         *
         * @api
         * @access public
         *
         * @param string $createdAt
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setCreatedAt(string $createdAt): OrderInterface;

        /**
         * Gets expires at
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getExpiresAt(): string;

        /**
         * Gets expires at
         *
         * @api
         * @access public
         *
         * @param string $expiresAt
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setExpiresAt(string $expiresAt): OrderInterface;

        /**
         * Gets dispatch untill
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getDispatchUntil(): string;

        /**
         * Sets dispatch untill
         *
         * @api
         * @access public
         *
         * @param string $dispatch_untill
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setDispatchUntil(string $dispatchUntil): OrderInterface;

        /**
         * Gets courier tracking codes
         *
         * @api
         * @access public
         *
         * @return string[]
         */
        function getCourierTrackingCodes(): array;

        /**
         * Sets courier tracking codes
         *
         * @api
         * @access public
         *
         * @param string[] $courierTrackingCodes
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setCourierTrackingCodes(array $courierTrackingCodes): OrderInterface;

        /**
         * Sets line items
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface[]
         */
        function getLineItems(): array;

        /**
         * Sets courier
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface[] $lineItems
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setLineItems(array $lineItems): OrderInterface;

        /**
         * Gets comments
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getComments(): string;

        /**
         * Sets comments
         *
         * @api
         * @access public
         *
         * @param string $comment
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setComments(string $comment): OrderInterface;

        /**
         * Gets customer
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface|null
         */
        function getCustomer();

        /**
         * Sets customer
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\CustomerInterface|null
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setCustomer(?CustomerInterface $customer): OrderInterface;

        /**
         * Gets invoice details
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface|null
         */
        function getInvoiceDetails(): ?InvoiceDetailsInterface;

        /**
         * Sets invoice details
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface|null $invoiceDetails
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setInvoiceDetails(?InvoiceDetailsInterface $invoiceDetails): OrderInterface;

        /**
         * Sets courier
         *
         *
         * @api
         * @access public
         *
         * @return string
         */
        function getCourier(): string;

        /**
         * Sets courier
         *
         * @api
         * @access public
         *
         * @param string $courier
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setCourier(string $courier): OrderInterface;

        /**
         * Gets courier voucher
         *
         * @api
         * @access public
         *
         * @return string|null
         */
        function getCourierVoucher(): ?string;

        /**
         * Sets courier voucher
         *
         * @api
         * @access public
         *
         * @param string|null $courierVoucher
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setCourierVoucher(?string $courierVoucher): OrderInterface;

        /**
         * Gets Rejection Info
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface|null
         */
        function getRejectionInfo(): ?RejectionInfoInterface;

        /**
         * Sets Rejection Info
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface|null $rejectionInfo
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setRejectionInfo(?RejectionInfoInterface $rejectionInfo);

        /**
         * Gets accept options
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface|null
         */
        function getAcceptOptions(): ?AcceptOptionsInterface;

        /**
         * Sets accept options
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface|null $acceptOptions

         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setAcceptOptions(?AcceptOptionsInterface $acceptOptions): OrderInterface;

        /**
         * Gets reject options
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface|null
         */
        function getRejectOptions(): ?RejectOptionsInterface;

        /**
         * Sets reject options
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface|null $rejectOptions
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setRejectOptions(?RejectOptionsInterface $rejectOptions): OrderInterface;

        /**
         * Gets Magento Order
         *
         * @api
         * @access public
         *
         * @return \Magento\Sales\Api\Data\OrderInterface|null
         */
        function getMagentoOrder(): ?MagentoOrderInterface;

        /**
         * Sets Magento Order
         *
         * @api
         * @access public
         *
         * @param \Magento\Sales\Api\Data\OrderInterface|null $magentoOrder
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setMagentoOrder($magentoOrder): OrderInterface;

        /**
         * Gets Express
         *
         * @api
         * @access public
         *
         * @return bool
         */
        function getExpress(): bool;

        /**
         * Sets Express
         *
         * @api
         * @access public
         *
         * @param bool $express
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setExpress(bool $express): OrderInterface;

        /**
         * Gets Custom
         *
         * @api
         * @access public
         *
         * @return bool
         */
        function getCustom(): bool;

        /**
         * Sets Custom
         *
         * @api
         * @access public
         *
         * @param bool $custom
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setCustom(bool $custom): OrderInterface;

        /**
         * Gets Gift Wrap
         *
         * @api
         * @access public
         *
         * @return bool
         */
        function getGiftWrap(): bool;

        /**
         * Sets Gift Wrap
         *
         * @api
         * @access public
         *
         * @param bool $giftWrap
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setGiftWrap(bool $giftWrap): OrderInterface;

        /**
         * Gets Fulfilled By Skroutz
         *
         * @api
         * @access public
         *
         * @return bool
         */
        function getFulfilledBySkroutz(): bool;

        /**
         * Sets Fulfilled By Skroutz
         *
         * @api
         * @access public
         *
         * @param bool $fulfilledBySkroutz
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setFulfilledBySkroutz(bool $fulfilledBySkroutz): OrderInterface;

        /**
         * Gets Fbs Delivery Note
         *
         * @api
         * @access public
         *
         * @return string|null
         */
        function getFbsDeliveryNote(): ?string;

        /**
         * Sets Fbs Delivery Note
         *
         * @api
         * @access public
         *
         * @param string|null $fbsDeliveryNote
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setFbsDeliveryNote(?string $fbsDeliveryNote): OrderInterface;

        /**
         * Gets Pickup Window
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface|null
         */
        function getPickupWindow(): ?OrderPickupWindowInterface;

        /**
         * Sets Pickup Window
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderPickupWindowInterface|null $pickupWindow
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setPickupWindow(?OrderPickupWindowInterface $pickupWindow);

        /**
         * Gets Pickup Address
         *
         * @api
         * @access public
         *
         * @return string|null
         */
        function getPickupAddress(): ?string;

        /**
         * Sets Pickup Address
         *
         * @api
         * @access public
         *
         * @param string|null $pickupAddress
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setPickupAddress(?string $pickupAddress);

        /**
         * Gets Number Of Parcels
         *
         * @api
         * @access public
         *
         * @return int|null
         */
        function getNumberOfParcels(): ?int;

        /**
         * Sets Number Of Parcels
         *
         * @api
         * @access public
         *
         * @param int|null $numberOfParcels
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function setNumberOfParcels(?int $numberOfParcels): OrderInterface;
    }
?>