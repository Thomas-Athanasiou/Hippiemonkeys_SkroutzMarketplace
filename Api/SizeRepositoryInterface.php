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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeSearchResultInterface as SearchResultInterface;

    interface SizeRepositoryInterface
    {
        /**
         * Gets Size by Id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function getById($id): SizeInterface;


        /**
         * Gets list by Search Criteria
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface;

        /**
         * Deletes Size
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         *
         * @return bool
         */
        function delete(SizeInterface $size): bool;

        /**
         * Saves Size
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface $size
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface
         */
        function save(SizeInterface $size): SizeInterface;
    }
?>