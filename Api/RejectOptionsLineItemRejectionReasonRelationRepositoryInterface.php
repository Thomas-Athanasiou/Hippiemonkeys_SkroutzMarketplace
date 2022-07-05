<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys Web Inteligence EE (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsLineItemRejectionReasonRelationInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\LineItemRejectionReasonInterface;

    interface RejectOptionsLineItemRejectionReasonRelationRepositoryInterface
    {
        function getById($id): RejectOptionsLineItemRejectionReasonRelationInterface;

        function getByRejectOptionsAndLineItemRejectionReason(RejectOptionsInterface $rejectOptions, LineItemRejectionReasonInterface $lineItemRejectionReason) : RejectOptionsLineItemRejectionReasonRelationInterface;

        function delete(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): bool;

        function save(RejectOptionsLineItemRejectionReasonRelationInterface $rejectOptionsLineItemRejectionReasonRelation): RejectOptionsLineItemRejectionReasonRelationInterface;
    }
?>