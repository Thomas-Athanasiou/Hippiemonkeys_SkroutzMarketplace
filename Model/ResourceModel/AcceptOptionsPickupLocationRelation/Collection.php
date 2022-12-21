<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\AcceptOptionsPickupLocationRelation;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\AcceptOptionsPickupLocationRelation as Model,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\AcceptOptionsPickupLocationRelation as ResourceModel,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Collection\AbstractCollection;

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