<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagentoEse\B2bAdminConfigurations\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Theme\Model\Theme\Registration as ThemeRegistration;
use Magento\Config\Model\ResourceModel\Config as ResourceConfig;
use Magento\Theme\Model\ResourceModel\Theme\Collection as ThemeCollection;

class OldInstallData implements DataPatchInterface, PatchVersionInterface
{
    /** @var ThemeRegistration  */
    private $themeRegistration;

    /** @var ResourceConfig  */
    private $resourceConfig;

    /** @var ThemeCollection  */
    private $themeCollection;

    public function __construct(ThemeRegistration $themeRegistration,
                                ResourceConfig $resourceConfig,
                                ThemeCollection $themeCollection)
    {
        $this->themeRegistration = $themeRegistration;
        $this->resourceConfig = $resourceConfig;
        $this->themeCollection = $themeCollection;
    }

    public function apply()
    {
        //make sure theme is registered
        $this->themeRegistration->register();
        //get id of brentmill theme
        $themeId = $this->themeCollection->getThemeByFullPath('frontend/MagentoEse/brentmill')->getThemeId();
        $this->resourceConfig->saveConfig(
            "btob/website_configuration/company_active", "1", "default", 0)->saveConfig(
            "btob/website_configuration/negotiablequote_active", "1", "default", 0)->saveConfig(
            "btob/website_configuration/quickorder_active", "1", "default", 0)->saveConfig(
            "btob/website_configuration/requisition_list_active", "1", "default", 0)->saveConfig(
            "btob/website_configuration/sharedcatalog_active", "1", "default", 0)->saveConfig(
            "catalog/magento_catalogpermissions/enabled", "1", "default", 0)->saveConfig(
            "catalog/magento_catalogpermissions/grant_catalog_category_view", "1", "default", 0)->saveConfig(
            "catalog/magento_catalogpermissions/grant_catalog_product_price", "1", "default", 0)->saveConfig(
            "catalog/magento_catalogpermissions/grant_checkout_items", "1", "default", 0)->saveConfig(
            "catalog/layered_navigation/interval_division_limit", "10", "default", 0)->saveConfig(
            "catalog/layered_navigation/price_range_calculation", "improved", "default", 0)->saveConfig(
            "cataloginventory/item_options/min_sale_qty", "5", "default", 0)->saveConfig(
            "payment/companycredit/active", "1", "default", 0)->saveConfig(
            "design/theme/theme_id", $themeId, "default", 0);
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