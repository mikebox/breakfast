<?php
namespace Training\Retailers\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Training\Retailers\Model\ResourceModel\Retailer;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $retailerProducts = [
              [ 'retailer_id'   =>  1, 'product_id' =>  1],
              [ 'retailer_id'   =>  1, 'product_id' =>  2],
              [ 'retailer_id'   =>  1, 'product_id' =>  3],
              [ 'retailer_id'   =>  1, 'product_id' =>  4],
              [ 'retailer_id'   =>  1, 'product_id' =>  5],
              [ 'retailer_id'   =>  2, 'product_id' =>  2],
              [ 'retailer_id'   =>  2, 'product_id' =>  3],
              [ 'retailer_id'   =>  2, 'product_id' =>  6],
              [ 'retailer_id'   =>  3, 'product_id' =>  7],
              [ 'retailer_id'   =>  3, 'product_id' =>  1],
              [ 'retailer_id'   =>  4, 'product_id' =>  4]
            ];

            foreach ($retailerProducts as $retailerProduct)
            {
                $setup->getConnection()->insertForce($setup->getTable(Retailer::ENTITY_PRODUCT_TABLE), $retailerProduct);
            }
        }

        if (version_compare($context->getVersion(), '1.0.2', '<'))
        {
            $setup->getConnection()->insertForce($setup->getTable(Retailer::ENTITY_PRODUCT_TABLE), ['retailer_id' => 5, 'product_id' => 4]);
        }
    }
}