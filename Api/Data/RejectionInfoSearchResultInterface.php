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
    interface RejectionInfoSearchResultInterface
    extends SearchResultsInterface
    {
        /**
         * Gets collection of Rejection Info items
         *
         * @access public
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface[]
         */
        public function getItems();

        /**
         * Sets collection of Rejection Info items
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface[] $rejectionInfos
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoSearchResultInterface
         */
        public function setItems(array $rejectionInfos);
    }
?>