<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\PickupWindow;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupWindowSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\PickupWindow as Model,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\PickupWindow as ResourceModel,
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