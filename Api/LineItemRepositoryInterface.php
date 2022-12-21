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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Magento\Framework\Api\SearchCriteriaInterface,

        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemInterface;

    interface LineItemRepositoryInterface
    {
        function getByLocalId(int $id): LineItemInterface;

        function getBySkroutzId(string $skroutzId) : LineItemInterface;

        /**
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria The search criteria.
         * @return \Magento\Sales\Api\Data\OrderItemSearchResultInterface Order item search result interface.
         */
        function getList(SearchCriteriaInterface $searchCriteria);

        function delete(LineItemInterface $lineItem): bool;

        function save(LineItemInterface $lineItem): LineItemInterface;
    }
?>