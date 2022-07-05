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

    use Magento\Framework\Api\SearchResultsInterface;

    interface AddressSearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection items
         *
         * @api
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface[] Array of collection address items.
         */
        public function getItems();

        /**
         * Sets collection address items
         *
         * @api
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AddressInterface[] $address
         *
         * @return \this
         */
        public function setItems(array $address);
    }
?>