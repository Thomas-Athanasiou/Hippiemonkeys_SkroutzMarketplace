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

    namespace Hippiemonkeys\SkroutzMarketplace\Plugin;

    use Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface;

    class WebapiPickupLocationPlugin
    {
        /**
         * Processes before Webhook Event
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\SkroutzMarketplaceInterface $skroutzMarketplace
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface $order
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\Data\OrderInterface
         */
        public function afterGetOrder(SkroutzMarketplaceInterface $skroutzMarketplace, OrderInterface $order): OrderInterface
        {
            $acceptOptions = $order->getAcceptOptions();
            if($acceptOptions !== null)
            {
                $pickupLocations = $acceptOptions->getPickupLocation();
                foreach ($pickupLocations as $pickupLocation)
                {
                    $id = (string) $pickupLocation->getId();
                    if($id !== '')
                    {
                        $pickupLocation->setSkroutzId($id);
                        $pickupLocation->setId(null);
                    }
                }
            }

            return $order;
        }
    }
?>