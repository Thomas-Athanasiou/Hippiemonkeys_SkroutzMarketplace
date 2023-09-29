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

    use Magento\Framework\Api\SearchResultsInterface;

    /**
     * @api
     */
    interface LineItemRejectionReasonSearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection of Line Item Rejection Reason items
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface[]
         */
        public function getItems();

        /**
         * Sets collection Line Item Rejection Reason  items.
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonInterface[] $lineItemRejectionReasons
         *
         * @return mixed
         */
        public function setItems(array $lineItemRejectionReasons);
    }
?>