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
        Magento\Sales\Api\Data\OrderInterface as MagentoOrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterface as SearchResultInterface;

    interface OrderRepositoryInterface
    {
        /**
         * Gets Order by Id
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function getById($id): OrderInterface;

        /**
         * Gets Order by Code
         *
         * @api
         * @access public
         *
         * @param string $code
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function getByCode(string $code): OrderInterface;

        /**
         * Gets Order by Magento Order
         *
         * @api
         * @access public
         *
         * @param \Magento\Sales\Api\Data\OrderInterface $magentoOrder
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function getByMagentoOrder(MagentoOrderInterface $magentoOrder): OrderInterface;

        /**
         * Gets list by Search Criteria
         *
         * @api
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface;

        /**
         * Deletes Order
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         *
         * @return bool
         */
        function delete(OrderInterface $order): bool;

        /**
         * Saves Order
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        function save(OrderInterface $order): OrderInterface;
    }
?>