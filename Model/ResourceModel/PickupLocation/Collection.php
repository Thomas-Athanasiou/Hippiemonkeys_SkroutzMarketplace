<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\PickupLocation;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\PickupLocationSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\PickupLocation as Model,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\PickupLocation as ResourceModel,
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