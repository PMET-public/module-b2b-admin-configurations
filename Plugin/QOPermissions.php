<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MagentoEse\B2bAdminConfigurations\Plugin;

/**
 * Class Permissions.
 */
class QOPermissions
{
    /**
     * Check product permissions.
     *
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return bool
     */
    public function afterIsProductPermissionsValid(\Magento\QuickOrder\Model\CatalogPermissions\Permissions $subject)
    {
       return true;
    }

}
