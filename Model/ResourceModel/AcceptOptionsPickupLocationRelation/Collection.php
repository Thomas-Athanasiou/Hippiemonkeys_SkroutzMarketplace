<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptionsPickupLocationRelation;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\AcceptOptionsPickupLocationRelation as Model,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptionsPickupLocationRelation as ResourceModel,
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