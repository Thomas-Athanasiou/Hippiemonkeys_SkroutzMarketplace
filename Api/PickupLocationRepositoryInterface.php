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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationSearchResultInterface as SearchResultInterface;

    interface PickupLocationRepositoryInterface
    {
        /**
         * Gets Pickup Location by Id
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface
         */
        function getById($id): PickupLocationInterface;

        /**
         * Gets Pickup Location by Skroutz Id
         *
         * @access public
         *
         * @param string $skroutzId
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface
         */
        function getBySkroutzId(string $skroutzId): PickupLocationInterface;

        /**
         * Gets list by Search Criteria
         *
         * @access public
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationSearchResultInterface
         */
        function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface;

        /**
         * Deletes the Pickup Location instance from the repository
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return bool
         */
        function delete(PickupLocationInterface $pickupLocation): bool;

        /**
         * Saves the Pickup Location instance to the repository
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface $pickupLocation
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface
         */
        function save(PickupLocationInterface $pickupLocation): PickupLocationInterface;
    }
?>