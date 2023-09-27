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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\LineItemRejectionReason;

    use Hippiemonkeys\Core\Model\ResourceModel\Collection\AbstractCollection,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\LineItemRejectionReasonSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\LineItemRejectionReason as Model,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\LineItemRejectionReason as ResourceModel;

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