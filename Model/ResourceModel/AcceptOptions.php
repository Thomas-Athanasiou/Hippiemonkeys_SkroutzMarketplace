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

    use Hippiemonkeys\Core\Model\ResourceModel\AbstractRelationResource,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\AcceptOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\AcceptOptionsResourceInterface;

    class AcceptOptions
    extends AbstractRelationResource
    implements AcceptOptionsResourceInterface
    {
        protected const
            TABLE_MAIN  = 'hippiemonkeys_skroutzMarketplace_acceptoptions';

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
        public function saveAcceptOptions(AcceptOptionsInterface $acceptOptions): AcceptOptionsResourceInterface
        {
            return $this->saveModel($acceptOptions);
        }

        /**
         * {@inheritdoc}
         */
        public function loadAcceptOptionsById(AcceptOptionsInterface $acceptOptions, $id): AcceptOptionsResourceInterface
        {
            return $this->loadModelById($acceptOptions, $id);
        }

        /**
         * {@inheritdoc}
         */
        public function deleteAcceptOptions(AcceptOptionsInterface $acceptOptions): bool
        {
            return $this->deleteModel($acceptOptions);
        }
    }
?>