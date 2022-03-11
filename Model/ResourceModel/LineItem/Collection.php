<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\LineItem;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\LineItem as Model,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\LineItem as ResourceModel,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Collection\AbstractCollection;

    class Collection
    extends AbstractCollection
    implements SearchResultInterface
    {
        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(Model::class, ResourceModel::class);
        }
    }
?>