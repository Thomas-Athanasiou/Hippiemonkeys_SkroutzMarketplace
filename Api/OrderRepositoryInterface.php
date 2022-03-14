<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou at Hippiemonkeys
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2022 Hippiemonkeys (https://hippiemonkeys.com)
     * @package Hippiemonkeys_SkroutzSmartCart
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzSmartCart\Api;

    use  Magento\Sales\Api\Data\OrderInterface as MagentoOrderInterface,
        Hippiemonkeys\SkroutzSmartCart\Api\Data\OrderInterface;

    interface OrderRepositoryInterface
    {
        function getById($id): OrderInterface;
        function getByCode(string $code): OrderInterface;
        function getByMagentoOrder(MagentoOrderInterface $magentoOrder): OrderInterface;
        function delete(OrderInterface $order): bool;
        function save(OrderInterface $order): OrderInterface;
    }
?>