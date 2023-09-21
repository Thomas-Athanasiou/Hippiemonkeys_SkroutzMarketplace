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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\SizeResourceInterface;

    class Size
    extends AbstractResource
    implements SizeResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzmarketplace_size';

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
        public function saveSize(SizeInterface $size): self
        {
            return $this->saveModel($size);
        }

        /**
         * @inheritdoc
         */
        public function loadSizeById(SizeInterface $size, $id): self
        {
            return $this->loadModelById($size, $id);
        }

        /**
         * @inheritdoc
         */
        public function deleteSize(SizeInterface $size): bool
        {
            return $this->deleteModel($size);
        }
    }
?>