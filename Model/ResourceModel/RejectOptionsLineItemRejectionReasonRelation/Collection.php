<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\RejectOptionsLineItemRejectionReasonRelation;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsLineItemRejectionReasonRelationSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\RejectOptionsLineItemRejectionReasonRelation as Model,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\RejectOptionsLineItemRejectionReasonRelation as ResourceModel,
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