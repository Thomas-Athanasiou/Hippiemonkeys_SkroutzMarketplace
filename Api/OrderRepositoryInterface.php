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

    use  Magento\Sales\Api\Data\OrderInterface as MagentoOrderInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface;

    interface OrderRepositoryInterface
    {
        function getById($id): OrderInterface;
        function getByCode(string $code): OrderInterface;
        function getByMagentoOrder(MagentoOrderInterface $magentoOrder): OrderInterface;
        function delete(OrderInterface $order): bool;
        function save(OrderInterface $order): OrderInterface;
    }
?>