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

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface;

    interface RejectionInfoRepositoryInterface
    {
        /**
         * Gets Rejection Info instance by ID
         *
         * @access public
         *
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface
         */
        function getById($id): RejectionInfoInterface;

        /**
         * Deletes the Rejection Info instance from the repository
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface $rejectionInfo
         *
         * @return bool
         */
        function delete(RejectionInfoInterface $rejectionInfo): bool;

        /**
         * Saves the Rejection Info instance to the repository
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface $rejectionInfo
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface
         */
        function save(RejectionInfoInterface $rejectionInfo): RejectionInfoInterface;
    }
?>