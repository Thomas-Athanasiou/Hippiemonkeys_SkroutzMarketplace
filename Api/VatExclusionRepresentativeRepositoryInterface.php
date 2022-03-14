<?php
    /**
     * @author Thomas Athanasiou at Hippiemonkeys | @Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\VatExclusionRepresentativeInterface;

    interface VatExclusionRepresentativeRepositoryInterface
    {
        function getById($id): VatExclusionRepresentativeInterface;

        function delete(VatExclusionRepresentativeInterface $vatExclusionRepresentative): bool;

        function save(VatExclusionRepresentativeInterface $vatExclusionRepresentative): VatExclusionRepresentativeInterface;
    }
?>