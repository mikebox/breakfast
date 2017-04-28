<?php
namespace Training\Retailers\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Training\Retailers\Model\ResourceModel\Retailer;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<'))
        {
            $tableName = $setup->getTable(Retailer::ENTITY_PRODUCT_TABLE);
            if (!$setup->tableExists($tableName))
            {
                $setup->startSetup();

                $table = $setup->getConnection()->newTable($tableName)
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'unsigned'  =>  true,
                            'nullable'  =>  false,
                            'primary'   =>  true,
                            'identity'  =>  true
                        ],
                        'Retailer Product ID'
                    )->addColumn(
                        'retailer_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'unsigned'  =>  true,
                            'nullable'   =>  false
                        ],
                        'Retailer ID'
                    )->addColumn(
                        'product_id',
                        Table::TYPE_INTEGER,
                        10,
                        [
                            'unsigned'  =>  true,
                            'nullable'   =>  false
                        ],
                        'Product ID'
                    )->addIndex(
                        $setup->getIdxName($tableName, ['product_id']),
                        ['product_id']
                    )->addForeignKey(
                        $setup->getFkName($tableName, 'retailer_id', 'training_retailers', 'id'),
                        'retailer_id',
                        $setup->getTable('training_retailers'),
                        'id',
                        Table::ACTION_CASCADE
                    )->addForeignKey(
                        $setup->getFkName($tableName, 'product_id', 'catalog_product_entity', 'entity_id'),
                        'product_id',
                        $setup->getTable('catalog_product_entity'),
                        'entity_id',
                        Table::ACTION_CASCADE
                    )->setComment('Retailers Products Table');

                $setup->getConnection()->createTable($table);

                $setup->endSetup();
            }
        }
    }
}