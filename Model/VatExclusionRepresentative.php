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

    namespace Hippiemonkeys\SkroutzMarketplace\Model;

    use Magento\Framework\Model\AbstractModel,
        Hippiemonkeys\SkroutzMarketplace\Model\Spi\VatExclusionRepresentativeResourceInterface as ResourceInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface;

    class VatExclusionRepresentative
    extends AbstractModel
    implements VatExclusionRepresentativeInterface
    {
        /**
         * {@inheritdoc}
         */
        public function getIdType(): string
        {
            return $this->getData(ResourceInterface::FIELD_ID_TYPE);
        }

        /**
         * {@inheritdoc}
         */
        public function setIdType(string $idType): VatExclusionRepresentativeInterface
        {
            return $this->setData(ResourceInterface::FIELD_ID_TYPE, $idType);
        }

        /**
         * {@inheritdoc}
         */
        function getIdNumber(): string
        {
            return $this->getData(ResourceInterface::FIELD_ID_NUMBER);
        }

        /**
         * {@inheritdoc}
         */
        public function setIdNumber(string $idNumber): VatExclusionRepresentativeInterface
        {
            return $this->setData(ResourceInterface::FIELD_ID_NUMBER, $idNumber);
        }

        /**
         * {@inheritdoc}
         */
        public function getOtp(): string
        {
            return $this->getData(ResourceInterface::FIELD_OTP);
        }

        /**
         * {@inheritdoc}
         */
        public function setOtp(string $otp): VatExclusionRepresentativeInterface
        {
            return $this->setData(ResourceInterface::FIELD_OTP, $otp);
        }
    }
?>