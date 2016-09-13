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

 class InstallData implements InstallDataInterface {
   public $_resourceConfig;
     /**
      * @var \Magento\Framework\App\Config\ScopeConfigInterface
      */
     protected $resourceConfig;
     protected $themeCollection;

   public function __construct(
       \Magento\Config\Model\ResourceModel\Config $resourceConfig,
       \Magento\Theme\Model\ResourceModel\Theme\Collection $themeCollection
   ) {
       $this->_resourceConfig = $resourceConfig;
       $this->themeCollection = $themeCollection;
   }
  
     public function install( ModuleDataSetupInterface $setup, ModuleContextInterface $context )
     {

         //get id of brentmill theme
         $themeId = $this->themeCollection->getThemeByFullPath('frontend/MagentoEse/brentmill')->getThemeId();
         $this->_resourceConfig->saveConfig(
             "btob/website_configuration/company_active", "1", "default", 0)->saveConfig(
             "btob/website_configuration/negotiablequote_active", "1", "default", 0)->saveConfig(
             "btob/website_configuration/quickorder_active", "1", "default", 0)->saveConfig(
             "btob/website_configuration/requisition_list_active", "1", "default", 0)->saveConfig(
             //"btob/website_configuration/sharedcatalog_active", "1", "default", 0)->saveConfig(
             //"btob/website_configuration/sharedcatalog_active", "1", "default", 0)->saveConfig(
             ///"catalog/magento_catalogpermissions/enabled", "1", "default", 0)->saveConfig(
             //"catalog/magento_catalogpermissions/grant_catalog_category_view", "1", "default", 0)->saveConfig(
             //"catalog/magento_catalogpermissions/grant_catalog_product_price", "1", "default", 0)->saveConfig(
            // "catalog/magento_catalogpermissions/grant_checkout_items", "1", "default", 0)->saveConfig(
             "catalog/layered_navigation/interval_division_limit", "10", "default", 0)->saveConfig(
             "catalog/layered_navigation/price_range_calculation", "improved", "default", 0)->saveConfig(
             "cataloginventory/item_options/min_sale_qty", "5", "default", 0)->saveConfig(
             "design/theme/theme_id", $themeId, "default", 0)->saveConfig(
             "admin/security/session_lifetime", "900000", "default", 0)->saveConfig(
             "system/full_page_cache/ttl", "8640000", "default", 0)->saveConfig(
             "web/cookie/cookie_lifetime", "604800", "default", 0)->saveConfig(
             "admin/security/admin_account_sharing", "1", "default", 0)->saveConfig(
             "web/seo/use_rewrites", "1", "default", 0);
     }
}
