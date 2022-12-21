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

    namespace Hippiemonkeys\SkroutzMarketplace\Api;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\VatExclusionRepresentativeInterface;

    interface VatExclusionRepresentativeRepositoryInterface
    {
        function getById($id): VatExclusionRepresentativeInterface;

        function delete(VatExclusionRepresentativeInterface $vatExclusionRepresentative): bool;

        function save(VatExclusionRepresentativeInterface $vatExclusionRepresentative): VatExclusionRepresentativeInterface;
    }
?>