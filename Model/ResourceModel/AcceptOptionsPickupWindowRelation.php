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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupWindowRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupWindowRelationResourceInterface,
        Magento\Framework\Model\AbstractModel;

    class AcceptOptionsPickupWindowRelation
    extends AbstractResource
    implements AcceptOptionsPickupWindowRelationResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzMarketplace_acceptoptionspickupwindow_r';

        /**
         * @inheritdoc
         */
        protected function _construct()
        {
            $this->_init(static::TABLE_MAIN, static::FIELD_ID);
        }

        public function loadByAcceptOptionsIdAndPickupWindow(AbstractModel $object, int $acceptOptionsId, int $pickupWindowId)
        {
            $idField = self::FIELD_ID;

            $acceptOptionsIdField       = static::FIELD_ACCEPT_OPTIONS_ID;
            $acceptOptionsIdPlaceholder = ':'.$acceptOptionsIdField;

            $pickupWindowField          = self::FIELD_PICKUP_WINDOW_ID;
            $pickupWindowPlaceholder    = ':'.$pickupWindowField;

            $connection = $this->getConnection();
            return $this->load(
                $object,
                $connection->fetchOne(
                    $connection->select()
                        ->from($this->getMainTable(), $idField)
                        ->where($acceptOptionsIdField . '=' . $acceptOptionsIdPlaceholder . ' AND ' . $pickupWindowField . '=' . $pickupWindowPlaceholder),
                    [
                        $acceptOptionsIdPlaceholder => $acceptOptionsId,
                        $pickupWindowPlaceholder    => $pickupWindowId
                    ]
                ),
                $idField
            );
        }

        /**
         * {@inheritdoc}
         */
        public function saveAcceptOptionsPickupWindowRelation(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation): AcceptOptionsPickupWindowRelationResourceInterface
        {
            return $this->saveModel($acceptOptionsPickupWindowRelation);
        }

        /**
         * {@inheritdoc}
         */
        public function loadAcceptOptionsPickupWindowRelationById(AcceptOptionsPickupWindowRelationInterface $acceptOptionsPickupWindowRelation, $id): AcceptOptionsPickupWindowRelationResourceInterface
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