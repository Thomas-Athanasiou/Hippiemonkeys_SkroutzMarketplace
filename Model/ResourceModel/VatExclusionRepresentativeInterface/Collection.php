<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\VatExclusionRepresentative;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\VatExclusionRepresentativeSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\VatExclusionRepresentative as Model,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\VatExclusionRepresentative as ResourceModel,
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