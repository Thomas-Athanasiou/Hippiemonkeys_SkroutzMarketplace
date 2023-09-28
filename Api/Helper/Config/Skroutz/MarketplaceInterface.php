<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_Skroutz
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Api\Helper\Config\Skroutz;

    use Hippiemonkeys\Skroutz\Api\Helper\Config\SkroutzInterface,
        Magento\Catalog\Api\Data\ProductInterface as MagentoProductInterface;

    /**
     * @api
     */
    interface MarketplaceInterface
    extends SkroutzInterface
    {
        /**
         * Gets Magento Products's Link Identity
         *
         * @access public
         *
         * @param \Magento\Catalog\Api\Data\ProductInterface $magentoProduct
         *
         * @return string|null
         */
        function getMagentoProductIdentity(MagentoProductInterface $magentoProduct): ?string;

        /**
         * Gets Magento Products From Link Identity
         *
         * @access public
         *
         * @param string $identity
         *
         * @return \Magento\Catalog\Api\Data\ProductInterface $magentoProduct
         */
        function getMagentoProductFromIdentity(string $identity): ?MagentoProductInterface;
    }
?>