<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Collection;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection as MagentoAbstractCollection,
        Hippiemonkeys\SkroutzSmartCart\Model\PickupLocation as Model,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\PickupLocation as ResourceModel;

    class AbstractCollection
    extends MagentoAbstractCollection
    {
        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(Model::class, ResourceModel::class);
        }

        private $_searchCriteria;

        /**
         * @inheritdoc
         */
        public function getSearchCriteria()
        {
            return $this->_searchCriteria;
        }
        /**
         * @inheritdoc
         */
        public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
        {
            $this->_searchCriteria = $searchCriteria;
            return $this;
        }

        /**
         * @inheritdoc
         */
        public function getTotalCount()
        {
            return $this->getSize();
        }
        /**
         * @inheritdoc
         */
        public function setTotalCount($totalCount)
        {
            return $this;
        }
        /**
         * @inheritdoc
         */
        public function setItems(array $items = null)
        {
            if (!$items) {
                return $this;
            }
            foreach ($items as $item) {
                $this->addItem($item);
            }
            return $this;
        }
    }
?>