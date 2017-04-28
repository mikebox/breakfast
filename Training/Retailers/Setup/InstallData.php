<?php
namespace Training\Retailers\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Training\Retailers\Model\ResourceModel\Retailer;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $retailers = [
            [
                'name'  =>  'First Retailer',
                'country_id'    =>  'US',
                'region_id'     =>  12,
                'city'      =>  'California',
            ],
            [
                'name'  =>  'Second Retailer',
                'country_id'    =>  'US',
                'region_id'     =>  13,
                'city'      =>  'Los Angeles',
            ],
            [
                'name'  =>  'Third Retailer',
                'country_id'    =>  'US',
                'region_id'     =>  14,
                'city'      =>  'Newy York',
            ],
            [
                'name'  =>  'Fourth Retailer',
                'country_id'    =>  'US',
                'region_id'     =>  15,
                'city'      =>  'Downtown',
            ],
            [
                'name'  =>  'Fifth Retailer',
                'country_id'    =>  'US',
                'region_id'     =>  16,
                'city'      =>  'Los Vegas',
            ]
        ];

        foreach ($retailers as $retailer)
        {
            $setup->getConnection()->insertForce($setup->getTable(Retailer::ENTITY_TABLE), $retailer);
        }
    }
}