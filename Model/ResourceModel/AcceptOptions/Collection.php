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

    namespace Magento\Sales\Model\ResourceModel\AcceptOptions;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\AcceptOptionsSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzSmartCart\Model\AcceptOptions as Model,
        Hippiemonkeys\SkroutzSmartCart\Model\ResourceModel\AcceptOptions as ResourceModel,
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