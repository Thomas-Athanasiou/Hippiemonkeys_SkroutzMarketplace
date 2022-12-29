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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel;

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\RejectionInfoResourceInterface;

    class RejectionInfo
    extends AbstractResource
    implements RejectionInfoResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzmarketplace_rejectioninfo';

        /**
         * {@inheritdoc}
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        /**
         * {@inheritdoc}
         */
        public function saveRejectionInfo(RejectionInfoInterface $rejectionInfo): RejectionInfoResourceInterface
        {
            return $this->saveModel($rejectionInfo);
        }

        /**
         * {@inheritdoc}
         */
        public function loadRejectionInfoById(RejectionInfoInterface $rejectionInfo, $id): RejectionInfoResourceInterface
        {
            return $this->loadModelById($rejectionInfo, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteRejectionInfo(RejectionInfoInterface $rejectionInfo): bool
        {
            return $this->deleteModel($rejectionInfo);
        }
    }
?>