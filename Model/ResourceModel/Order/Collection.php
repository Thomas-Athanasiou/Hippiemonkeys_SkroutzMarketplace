<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Order;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\Order as Model,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Order as ResourceModel,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\Collection\AbstractCollection;

    class Collection
    extends AbstractCollection
    implements SearchResultInterface
    {
        protected function _construct()
        {
            $this->_init(Model::class, ResourceModel::class);
        }
    }
?>