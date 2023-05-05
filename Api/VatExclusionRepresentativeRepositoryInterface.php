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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface;

    interface VatExclusionRepresentativeRepositoryInterface
    {

        /**
         * Gets Vat Exclusion Representative by Id
         *
         * @api
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface
         */
        function getById($id): VatExclusionRepresentativeInterface;

        /**
         * Deletes Vat Exclusion Representative
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface $vatExclusionRepresentative
         *
         * @return bool
         */
        function delete(VatExclusionRepresentativeInterface $vatExclusionRepresentative): bool;

        /**
         * Saves Vat Exclusion Representative
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface $vatExclusionRepresentative
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface
         */
        function save(VatExclusionRepresentativeInterface $vatExclusionRepresentative): VatExclusionRepresentativeInterface;
    }
?>