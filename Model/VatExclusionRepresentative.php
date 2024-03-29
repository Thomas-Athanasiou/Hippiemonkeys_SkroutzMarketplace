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

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Hippiemonkeys\Core\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\VatExclusionRepresentativeResourceInterface as ResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface;

    class VatExclusionRepresentative
    extends AbstractModel
    implements VatExclusionRepresentativeInterface
    {
        /**
         * @inheritdoc
         */
        public function getIdType(): string
        {
            return $this->getData(ResourceInterface::FIELD_ID_TYPE);
        }

        /**
         * @inheritdoc
         */
        public function setIdType(string $idType): self
        {
            return $this->setData(ResourceInterface::FIELD_ID_TYPE, $idType);
        }

        /**
         * @inheritdoc
         */
        public function getIdNumber(): string
        {
            return $this->getData(ResourceInterface::FIELD_ID_NUMBER);
        }

        /**
         * @inheritdoc
         */
        public function setIdNumber(string $idNumber): self
        {
            return $this->setData(ResourceInterface::FIELD_ID_NUMBER, $idNumber);
        }

        /**
         * @inheritdoc
         */
        public function getOtp(): string
        {
            return $this->getData(ResourceInterface::FIELD_OTP);
        }

        /**
         * @inheritdoc
         */
        public function setOtp(string $otp): self
        {
            return $this->setData(ResourceInterface::FIELD_OTP, $otp);
        }
    }
?>