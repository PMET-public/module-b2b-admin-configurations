<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagentoEse\B2bAdminConfigurations\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Store\Api\Data\WebsiteInterfaceFactory;
use Magento\Store\Api\Data\GroupInterfaceFactory;
use Magento\Store\Api\StoreRepositoryInterfaceFactory;
use Magento\Store\Api\GroupRepositoryInterfaceFactory;
use Magento\Store\Model\ResourceModel\Group;
use Magento\Store\Model\ResourceModel\Website;

class UpdateWebsiteAndStoreNames implements DataPatchInterface
{


    /** @var WebsiteInterfaceFactory  */
    private $websiteInterfaceFactory;

    /** @var GroupInterfaceFactory  */
    private $groupInterfaceFactory;

    /** @var StoreRepositoryInterfaceFactory  */
    private $storeRepositoryInterfaceFactory;

    /** @var GroupRepositoryInterfaceFactory  */
    private $groupRepositoryInterfaceFactory;

    /** @var Group  */
    private  $groupResourceModel;

    /** @var Website  */
    private $websiteResourceModel;

    public function __construct(
        WebsiteInterfaceFactory $websiteInterfaceFactory,
        GroupInterfaceFactory $groupInterfaceFactory,
        StoreRepositoryInterfaceFactory $storeRepositoryInterfaceFactory,
        GroupRepositoryInterfaceFactory $groupRepositoryInterfaceFactory,
        Group $groupResourceModel,
        Website $websiteResourceModel)
    {
        $this->websiteInterfaceFactory = $websiteInterfaceFactory;
        $this->groupInterfaceFactory = $groupInterfaceFactory;
        $this->storeRepositoryInterfaceFactory = $storeRepositoryInterfaceFactory;
        $this->groupRepositoryInterfaceFactory = $groupRepositoryInterfaceFactory;
        $this->groupResourceModel =  $groupResourceModel;
        $this->websiteResourceModel  = $websiteResourceModel;
    }

    public function apply()
    {
        //get website
        $website = $this->websiteInterfaceFactory->create();
        $website->load('base');
        //only go further if website name hasnt already been changed
        if ($website->getId()) {
            $website->setName('Brentmill B2B Website');
            $this->websiteResourceModel->save($website);
            $group = $this->groupInterfaceFactory->create();
            //Update Luma Store
            $existingGroupId = $this->getExistingGroupId('main_website_store');
            if($existingGroupId !=0) {
                $group->load($existingGroupId);
                $group->setName('Brentmill B2B Store');
                $group->setCode('brentmill_b2b_store');
                $this->groupResourceModel->save($group);
            }

        }
    }

    /**
     * @param $groupCode string
     * @return int
     */
    public function getExistingGroupId($groupCode){
        $groupRepository = $this->groupRepositoryInterfaceFactory->create();
        $groups=$groupRepository->getList();
        foreach($groups as $group){
            if($group->getCode()==$groupCode){
                return $group->getId();
                break;
            }
        }
        return 0;
    }

    /**
     * @param $storeCode string
     * @return int
     */
    public function getExistingStoreId($storeCode){
        $storeRepository = $this->storeRepositoryInterfaceFactory->create();
        $stores=$storeRepository->getList();
        foreach($stores as $store){
            if($store->getCode()==$storeCode){
                return $store->getId();
                break;
            }
        }
        return 0;
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