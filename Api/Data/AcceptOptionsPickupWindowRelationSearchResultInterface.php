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

    use Magento\Framework\Api\SearchResultsInterface;

    interface AcceptOptionsPickupWindowRelationSearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection items.
         *
         * @return \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterface[] Array of collection line items.
         */
        public function getItems();

        /**
         * Sets collection line items.
         *
         * @param \Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupWindowRelationInterface[] $acceptOptionsPickupWindowRelation
         * @return $this
         */
        public function setItems(array $acceptOptionsPickupWindowRelation);
    }
?>