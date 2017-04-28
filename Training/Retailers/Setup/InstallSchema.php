<?php
namespace Training\Retailers\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Training\Retailers\Model\ResourceModel\Retailer;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $tableName = $setup->getTable(Retailer::ENTITY_TABLE);
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
                    'Retailer ID'
                )->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'   =>  false
                    ],
                    'Retailer Name'
                )->addColumn(
                    'country_id',
                    Table::TYPE_TEXT,
                    2,
                    [
                        'nullable'   =>  false
                    ],
                    'Country Code'
                )->addColumn(
                    'region_id',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'unsigned'  =>  true,
                        'nullable'   =>  false
                    ],
                    'Region'
                )->addColumn(
                    'city',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'   =>  false
                    ],
                    'City'
                )->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    255,
                    [
                        'default'   =>  Table::TIMESTAMP_INIT,
                        'nullable'  =>  false
                    ],
                    'Created At'
                )->addIndex(
                    $setup->getIdxName($tableName, ['name']),
                    ['name']
                )->addForeignKey(
                    $setup->getFkName($tableName, 'country_id', 'directory_country', 'country_id'),
                    'country_id',
                    $setup->getTable('directory_country'),
                    'country_id',
                    Table::ACTION_CASCADE
                )->addForeignKey(
                    $setup->getFkName($tableName, 'region_id', 'directory_country_region', 'region_id'),
                    'region_id',
                    $setup->getTable('directory_country_region'),
                    'region_id',
                    Table::ACTION_CASCADE
                )->setComment('Retailers Table');

            $setup->getConnection()->createTable($table);

            $setup->endSetup();
        }
    }
}