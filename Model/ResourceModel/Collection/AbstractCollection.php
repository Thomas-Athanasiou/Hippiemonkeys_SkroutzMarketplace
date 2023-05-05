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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Collection;

    use Magento\Framework\Api\SearchCriteriaInterface,
        Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection as MagentoAbstractCollection,
        Hippiemonkeys\SkroutzMarketplace\Model\PickupLocation as Model,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\PickupLocation as ResourceModel;

    class AbstractCollection
    extends MagentoAbstractCollection
    {
        /**
         * {@inheritdoc}
         */
        protected function _construct()
        {
            $this->_init(Model::class, ResourceModel::class);
        }

        private $_searchCriteria;

        /**
         * {@inheritdoc}
         */
        public function getSearchCriteria()
        {
            return $this->_searchCriteria;
        }
        /**
         * {@inheritdoc}
         */
        public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
        {
            $this->_searchCriteria = $searchCriteria;
            return $this;
        }

        /**
         * {@inheritdoc}
         */
        public function getTotalCount()
        {
            return $this->getSize();
        }
        /**
         * {@inheritdoc}
         */
        public function setTotalCount($totalCount)
        {
            return $this;
        }
        /**
         * {@inheritdoc}
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