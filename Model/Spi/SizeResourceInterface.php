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

    namespace Hippiemonkeys\SkroutzMarketplace\Model\Spi;

    use Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface,
        Hippiemonkeys\Core\Model\Spi\ModelResourceInterface;

    /**
     * Accept Options Resource interface
     */
    interface SizeResourceInterface
    extends ModelResourceInterface
    {
        const
            FIELD_LABEL = 'label',
            FIELD_VALUE = 'value',
            FIELD_SHOP_VALUE = 'shop_value',
            FIELD_SHOP_VARIATION_UID = 'shop_variation_uid';

        /**
         * Save Size data
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface $size
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeResourceInterface
         */
        function saveSize(SizeInterface $size): SizeResourceInterface;

        /**
         * Load a Size by Id
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface $size
         * @param mixed $id
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeResourceInterface
         */
        function loadSizeById(SizeInterface $size, $id): SizeResourceInterface;

        /**
         * Delete the Size
         *
         * @api
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\SizeInterface $size
         *
         * @return bool
         */
        function deleteSize(SizeInterface $Size): bool;
    }
?>