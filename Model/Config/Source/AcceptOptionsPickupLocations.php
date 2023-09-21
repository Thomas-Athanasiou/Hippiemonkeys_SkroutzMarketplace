<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_ShippingTaxydromiki
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Config\Source;

    use Magento\Framework\Data\OptionSourceInterface,
        Magento\Framework\Api\SearchCriteriaInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\PickupLocationInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface;

    class AcceptOptionsPickupLocations
    implements OptionSourceInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface $pickupLocationRepository
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         */
        public function __construct(
            PickupLocationRepositoryInterface $pickupLocationRepository,
            SearchCriteriaInterface $searchCriteria
        )
        {
            $this->_pickupLocationRepository = $pickupLocationRepository;
            $this->_searchCriteria = $searchCriteria;
        }

        /**
         * @inheritdoc
         */
        public function toOptionArray()
        {
            return array_map(
                function(PickupLocationInterface $pickupLocation): array
                {
                    $label = $pickupLocation->getLabel();
                    $skroutzId = $pickupLocation->getSkroutzId();
                    return ['value' => $pickupLocation->getSkroutzId(), 'label' => "$label (ID: $skroutzId)"];
                },
                $this->getPickupLocationRepository()->getList($this->getSearchCriteria())->getItems()
            );
        }

        /**
         * Pickup Location Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface $_pickupLocationRepository
         */
        private $_pickupLocationRepository;

        /**
         * Gets Pickup Location Repository
         *
         * @access protected
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\PickupLocationRepositoryInterface
         */
        protected function getPickupLocationRepository(): PickupLocationRepositoryInterface
        {
            return $this->_pickupLocationRepository;
        }

        /**
         * Search Criteria property
         *
         * @access private
         *
         * @var \Magento\Framework\Api\SearchCriteriaInterface $_searchCriteria
         */
        private $_searchCriteria;

        /**
         * Gets Search Criteria
         *
         * @access protected
         *
         * @return \Magento\Framework\Api\SearchCriteriaInterface
         */
        protected function getSearchCriteria(): SearchCriteriaInterface
        {
            return $this->_searchCriteria;
        }
    }
?>