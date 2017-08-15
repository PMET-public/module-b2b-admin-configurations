<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagentoEse\B2bAdminConfigurations\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Event\ObserverInterface;

class InstallData implements InstallDataInterface
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $resourceConfig;

    /**
     * @var \Magento\Theme\Model\ResourceModel\Theme\Collection
     */
    protected $themeCollection;

    /**
     * @var \Magento\Theme\Model\Theme\Registration
     */
    protected $themeRegistration;

    /**
     * InstallData constructor.
     * @param \Magento\Config\Model\ResourceModel\Config $resourceConfig
     * @param \Magento\Theme\Model\ResourceModel\Theme\Collection $themeCollection
     * @param \Magento\Theme\Model\Theme\Registration $themeRegistration
     */
    public function __construct(
        \Magento\Config\Model\ResourceModel\Config $resourceConfig,
        \Magento\Theme\Model\ResourceModel\Theme\Collection $themeCollection,
        \Magento\Theme\Model\Theme\Registration $themeRegistration
    )
    {
        $this->_resourceConfig = $resourceConfig;
        $this->themeCollection = $themeCollection;
        $this->themeRegistration = $themeRegistration;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        //make sure theme is registered
        $this->themeRegistration->register();
        //get id of brentmill theme
        $themeId = $this->themeCollection->getThemeByFullPath('frontend/MagentoEse/brentmill')->getThemeId();
        $this->_resourceConfig->saveConfig(
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

}