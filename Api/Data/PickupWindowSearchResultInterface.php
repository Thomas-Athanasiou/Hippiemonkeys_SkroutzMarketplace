<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    use Magento\Framework\Api\SearchResultsInterface;

    interface PickupWindowSearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection items.
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface[] Array of collection line items.
         */
        public function getItems();

        /**
         * Sets collection line items.
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowInterface[] $pickupWindows
         * @return $this
         */
        public function setItems(array $pickupWindows);
    }
?>