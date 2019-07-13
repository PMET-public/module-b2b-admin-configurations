<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagentoEse\B2bAdminConfigurations\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Config\Model\ResourceModel\Config as ResourceConfig;

class ResetDefaultWelcomeMessage implements DataPatchInterface
{


    /** @var ResourceConfig  */
    private $resourceConfig;


    /**
     * UpdateSiteAndStoreInformation constructor.
     * @param ResourceConfig $resourceConfig
     */
    public function __construct(
        ResourceConfig $resourceConfig
    ) {
        $this->resourceConfig = $resourceConfig;

    }

    public function apply()
    {
         //reset default welcome message
        $this->resourceConfig->saveConfig("design/header/welcome", "Welcome!", "default", 0);
       }

    public static function getDependencies()
    {
        return [UpdateSiteAndStoreInformation::class];
    }

    public function getAliases()
    {
        return [];
    }
}
