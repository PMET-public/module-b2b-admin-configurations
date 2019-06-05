<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagentoEse\B2bAdminConfigurations\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Config\Model\ResourceModel\Config as ResourceConfig;

class UpdateSiteAndStoreInformation implements DataPatchInterface
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
        //Set the Store Information
        $this->resourceConfig->saveConfig("general/store_information/name", "Brentmill, Inc.", "default", 0)
            ->saveConfig("general/store_information/phone", "310-945-0345", "default", 0)
            ->saveConfig("general/store_information/hours", "9AM - 5PM", "default", 0)
            ->saveConfig("general/store_information/country_id", "US", "default", 0)
            ->saveConfig("general/store_information/region_id", "12", "default", 0)
            ->saveConfig("general/store_information/postcode", "90016", "default", 0)
            ->saveConfig("general/store_information/city", "Los Angeles", "default", 0)
            ->saveConfig("general/store_information/street_line1", "3640 Holdrege Ave", "default", 0);
        //Set Shipping Origin
        $this->resourceConfig->saveConfig("shipping/origin/city", "Los Angeles", "default", 0)
            ->saveConfig("shipping/origin/street_line1", "3640 Holdrege Ave", "default", 0)
            ->saveConfig("shipping/origin/postcode", "90016", "default", 0);
        //Set Site Meta Data
        //Luma
        $this->resourceConfig->saveConfig("design/head/default_title", "Brentmill Online Store", "default", 0)
            ->saveConfig("design/head/default_description", "Offering a huge selection of innovative products for the elecrical industry", "default", 0)
            ->saveConfig("design/head/default_keywords", "electrical,tools,wire,breakers", "default", 0);
            //remove default welcome message
        $this->resourceConfig->saveConfig("design/header/welcome", "", "default", 0);
        //enable RMA
        $this->resourceConfig->saveConfig("sales/magento_rma/use_store_addresssales/magento_rma/use_store_address", "1", "default", 0)
            ->saveConfig("sales/magento_rma/enabled_on_product", "1", "default", 0)
            ->saveConfig("sales/magento_rma/enabled", "1", "default", 0);
        }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
