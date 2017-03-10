<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagentoEse\B2bAdminConfigurations\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Event\ObserverInterface;

class UpgradeData implements UpgradeDataInterface
{
    public $_resourceConfig;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    private $encrypted;

    public function __construct(
        \Magento\Config\Model\ResourceModel\Config $resourceConfig,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Encryption\EncryptorInterface $encrypted
    ) {
        $this->_resourceConfig = $resourceConfig;
        $this->scopeConfig = $scopeConfig;
        $this->encrypted=$encrypted;
    }

    public function upgrade( ModuleDataSetupInterface $setup, ModuleContextInterface $context )
    {
        if (version_compare($context->getVersion(), '0.0.1', '<=')) {
            $this->_resourceConfig->saveConfig("google/analytics/account", "UA-53529203-6", "default", 0);
        }
        if (version_compare($context->getVersion(), '0.0.2', '<=')) {
            $this->_resourceConfig->saveConfig("payment/companycredit/max_order_total", "250000", "default", 0);
            $this->_resourceConfig->saveConfig("payment/companycredit/min_order_total", "1", "default", 0);
        }
    }

}
