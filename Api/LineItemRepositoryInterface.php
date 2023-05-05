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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemSearchResultInterface as SearchResultInterface;

    interface LineItemRepositoryInterface
    {
        /**
         * Gets Line Item by Id
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function getById($id): LineItemInterface;

        /**
         * Gets Line Item by Skroutz Id
         *
         * @api
         * @access public
         *
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function getBySkroutzId(string $skroutzId) : LineItemInterface;

        /**
         * Gets list by Search Criteria
         *
         * @api
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface;

        /**
         * Deletes a Line Iitem
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface $lineItem
         *
         * @return bool
         */
        function delete(LineItemInterface $lineItem): bool;

        /**
         * Saves Line Item
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface $lineItem
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface
         */
        function save(LineItemInterface $lineItem): LineItemInterface;
    }
?>