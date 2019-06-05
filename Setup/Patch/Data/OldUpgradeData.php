<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagentoEse\B2bAdminConfigurations\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Config\Model\ResourceModel\Config as ResourceConfig;

class OldUpgradeData implements DataPatchInterface,PatchVersionInterface
{

    /** @var ResourceConfig  */
    private $resourceConfig;


    public function __construct(ResourceConfig $resourceConfig)
    {
        $this->resourceConfig = $resourceConfig;
    }

    public function apply()
    {
        // version '0.0.1' add google analytics
            $this->resourceConfig->saveConfig("google/analytics/account", "UA-53529203-6", "default", 0);
        // version '0.0.2', set company credit limit
            $this->resourceConfig->saveConfig("payment/companycredit/max_order_total", "250000", "default", 0);
            $this->resourceConfig->saveConfig("payment/companycredit/min_order_total", "1", "default", 0);
        // version '0.0.3', set min sale
            $this->resourceConfig->saveConfig("cataloginventory/item_options/min_sale_qty", "1", "default", 0);

        // version '0.0.4' set layered nav price range
            $this->resourceConfig->saveConfig("catalog/layered_navigation/price_range_calculation", "auto", "default", 0);

    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public static function getVersion()
    {
        return '0.0.4';
    }
}