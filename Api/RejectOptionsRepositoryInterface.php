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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface;

    interface RejectOptionsRepositoryInterface
    {
        function getById($id): RejectOptionsInterface;

        /**
         * Get Reject Options by Order
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectOptionsInterface
         */
        function getByOrder(OrderInterface $order): RejectOptionsInterface;

        function delete(RejectOptionsInterface $rejectOptions): bool;

        function save(RejectOptionsInterface $rejectOptions): RejectOptionsInterface;
    }
?>