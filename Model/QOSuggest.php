<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MagentoEse\B2bAdminConfigurations\Model;

use Magento\Catalog\Api\Data\ProductInterface;

/**
 * Prepare product collection for suggestions functionality.
 */
class QOSuggest extends \Magento\QuickOrder\Model\ResourceModel\Product\Suggest
{
    /**
     * @var int
     */
    private $resultLimit;

    /**
     * @var \Magento\QuickOrder\Model\CatalogPermissions\Permissions
     */
    private $permissions;

    /**
     * @var \Magento\Framework\Search\Adapter\Mysql\TemporaryStorageFactory
     */
    private $tempStorageFactory;

    /**
     * @param \Magento\QuickOrder\Model\CatalogPermissions\Permissions $permissions
     * @param \Magento\Framework\Search\Adapter\Mysql\TemporaryStorageFactory $tempStorageFactory
     * @param int $resultLimit [optional]
     */
    public function __construct(
        \Magento\QuickOrder\Model\CatalogPermissions\Permissions $permissions,
        \Magento\Framework\Search\Adapter\Mysql\TemporaryStorageFactory $tempStorageFactory,
        $resultLimit = 10
    ) {
        $this->resultLimit = $resultLimit;
        $this->permissions = $permissions;
        $this->tempStorageFactory = $tempStorageFactory;
    }

    /**
     * Prepare product collection select. Add required constraints.
     *
     * @param \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection
     * @param \Magento\Framework\Api\Search\DocumentInterface[] $fulltextSearchResults
     * @return void
     */
    public function prepareProductCollection(
        \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection,
        $fulltextSearchResults
    ) {
        $productCollection->addAttributeToSelect(ProductInterface::NAME);
        $tempStorage = $this->tempStorageFactory->create();
        $table = $tempStorage->storeApiDocuments($fulltextSearchResults);
        $productCollection->getSelect()->joinInner(
            [
                'search_result' => $table->getName(),
            ],
            'e.entity_id = search_result.' . \Magento\Framework\Search\Adapter\Mysql\TemporaryStorage::FIELD_ENTITY_ID,
            []
        );
        //$this->permissions->applyPermissionsToProductCollection($productCollection);
        $productCollection->setPageSize($this->resultLimit)
            ->setOrder(
                [ProductInterface::SKU, ProductInterface::NAME],
                'ASC'
            );
    }
}
