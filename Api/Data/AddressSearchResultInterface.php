<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api\Data;

    use Magento\Framework\Api\SearchResultsInterface;

    interface AddressSearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection items.
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface[] Array of collection address items.
         */
        public function getItems();

        /**
         * Sets collection address items.
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface[] $address
         * @return $this
         */
        public function setItems(array $address);
    }
?>