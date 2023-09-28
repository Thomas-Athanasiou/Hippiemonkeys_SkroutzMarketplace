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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\VatExclusionRepresentativeResourceInterface;

    class VatExclusionRepresentative
    extends AbstractResource
    implements VatExclusionRepresentativeResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzmarketplace_vatexclusionrepresentative';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        /**
         * @inheritdoc
         */
        public function saveVatExclusionRepresentative(VatExclusionRepresentativeInterface $vatExclusionRepresentative): VatExclusionRepresentativeResourceInterface
        {
            return $this->saveModel($vatExclusionRepresentative);
        }

        /**
         * @inheritdoc
         */
        public function loadVatExclusionRepresentativeById(VatExclusionRepresentativeInterface $vatExclusionRepresentative, $id): VatExclusionRepresentativeResourceInterface
        {
            return $this->loadModelById($vatExclusionRepresentative, $id);
        }

        /**
         * @inheritdoc
         */
        public function deleteVatExclusionRepresentative(VatExclusionRepresentativeInterface $vatExclusionRepresentative): bool
        {
            return $this->deleteModel($vatExclusionRepresentative);
        }
    }
?>