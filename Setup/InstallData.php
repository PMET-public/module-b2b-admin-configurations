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
             "btob/website_configuration/sharedcatalog_active", "1", "default", 0)->saveConfig(
             "design/theme/theme_id", $themeId, "default", 0);
     }
}
