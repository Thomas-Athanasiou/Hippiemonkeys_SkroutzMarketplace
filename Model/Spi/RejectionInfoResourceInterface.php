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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface RejectionInfoResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_REASON = 'reason',
            FIELD_ACTOR = 'actor';

        /**
         * Save RejectionInfo data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface $rejectionInfo
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoResourceInterface
         */
        function saveRejectionInfo(RejectionInfoInterface $rejectionInfo): RejectionInfoResourceInterface;

        /**
         * Load a RejectionInfo by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface $rejectionInfo
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoResourceInterface
         */
        function loadRejectionInfoById(RejectionInfoInterface $rejectionInfo, $id): RejectionInfoResourceInterface;

        /**
         * Delete the RejectionInfo
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\RejectionInfoInterface $rejectionInfo
         *
         * @return bool
         */
        function deleteRejectionInfo(RejectionInfoInterface $rejectionInfo): bool;
    }
?>