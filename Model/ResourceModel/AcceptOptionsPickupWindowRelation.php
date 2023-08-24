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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupWindowRelationResourceInterface;

    class AcceptOptionsPickupWindowRelation
    extends AbstractResource
    implements AcceptOptionsPickupWindowRelationResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzmarketplace_acceptoptionspickupwindow_r';

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
        public function saveAcceptOptionsPickupWindowRelation(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation): self
        {
            return $this->saveModel($acceptOptionsPickupWindowRelation);
        }

        /**
         * {@inheritdoc}
         */
        public function loadAcceptOptionsPickupWindowRelationById(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation, $id): self
        {
            return $this->loadModelById($acceptOptionsPickupWindowRelation, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteAcceptOptionsPickupWindowRelation(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation): bool
        {
            return $this->deleteModel($acceptOptionsPickupWindowRelation);
        }
    }
?>