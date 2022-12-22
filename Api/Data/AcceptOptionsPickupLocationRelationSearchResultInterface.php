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

    use Magento\Framework\Api\SearchResultsInterface;

    interface AcceptOptionsPickupLocationRelationSearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection Accept Options Pickup Location Relation items
         *
         * @api
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface[] Array of collection line items.
         */
        public function getItems();

        /**
         * Sets collection Accept Options Pickup Location Relation items.
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface[] $acceptOptionsPickupLocationRelation
         *
         * @return mixed
         */
        public function setItems(array $acceptOptionsPickupLocationRelation);
    }
?>