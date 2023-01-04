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

    namespace Magento\Sales\Model\ResourceModel\AcceptOptions;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsSearchResultInterface as SearchResultInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\AcceptOptions as Model,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\AcceptOptions as ResourceModel,
        Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\Collection\AbstractCollection;

    class Collection
    extends AbstractCollection
    implements SearchResultInterface
    {
        /**
         * {@inheritdoc}
         */
        protected function _construct()
        {
            $this->_init(Model::class, ResourceModel::class);
        }
    }
?>