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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Config\Source;

    use Magento\Framework\Data\OptionSourceInterface;

    class MagentoProductIdentityField
    implements OptionSourceInterface
    {
        public const
            FIELD_ENTITY_ID = 'entity_id',
            FIELD_SKU = 'sku';

        /**
         * @inheritdoc
         */
        public function toOptionArray()
        {
            return [
                ['value' => self::FIELD_ENTITY_ID, 'label' => __('Entity ID')],
                ['value' => self::FIELD_SKU, 'label' => __('SKU')]
            ];
        }
    }
?>