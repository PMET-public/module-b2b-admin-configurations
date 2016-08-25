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
     protected $scopeConfig;
     private $encrypted;
     const BRAINTREE_PUBLICKEY = 'sn6xgt8pqv8868pq';
     const BRAINTREE_PRIVATEKEY = 'ad7807895eae5bd5a3cc913005eaefe8';
   public function __construct(
       \Magento\Config\Model\ResourceModel\Config $resourceConfig
   ) {
       $this->_resourceConfig = $resourceConfig;
   }
  
     public function install( ModuleDataSetupInterface $setup, ModuleContextInterface $context )
     {

         $this->_resourceConfig->saveConfig(
             "btob/website_configuration/company_active", "1", "default", 0)->saveConfig(
             "btob/website_configuration/negotiablequote_active", "1", "default", 0)->saveConfig(
             "btob/website_configuration/quickorder_active", "1", "default", 0)->saveConfig(
             "btob/website_configuration/requisition_list_active", "1", "default", 0)->saveConfig(
             "btob/website_configuration/sharedcatalog_active", "1", "default", 0);
     }
}   
