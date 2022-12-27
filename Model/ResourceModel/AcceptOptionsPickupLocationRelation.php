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
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsPickupLocationRelationInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsPickupLocationRelationResourceInterface;

    class AcceptOptionsPickupLocationRelation
    extends AbstractResource
    implements AcceptOptionsPickupLocationRelationResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzMarketplace_acceptoptionspickuplocation_r';

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
        public function saveAcceptOptionsPickupLocationRelation(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation): AcceptOptionsPickupLocationRelationResourceInterface
        {
            return $this->saveModel($acceptOptionsPickupLocationRelation);
        }

        /**
         * {@inheritdoc}
         */
        public function loadAcceptOptionsPickupLocationRelationById(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation, $id): AcceptOptionsPickupLocationRelationResourceInterface
        {
            return $this->loadModelById($acceptOptionsPickupLocationRelation, $id);
        }

        /**
         * {@inheritdoc}
         */
        function deleteAcceptOptionsPickupLocationRelation(AcceptOptionsPickupLocationRelationInterface $acceptOptionsPickupLocationRelation): bool
        {
            return $this->deleteModel($acceptOptionsPickupLocationRelation);
        }
    }
?>