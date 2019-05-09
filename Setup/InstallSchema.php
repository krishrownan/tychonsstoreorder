<?php


namespace Tychons\Storeorder\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $scheduler = $setup->getConnection()->newTable($setup->getTable('tychons_storeorder_scheduler'));

        $scheduler->addColumn(
            'scheduler_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        )
        ->addColumn(
            'days_week',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'days_week'
        )
        ->addColumn(
            'time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'time'
        )->setComment("Greeting Message table");;

        $setup->getConnection()->createTable($scheduler);

        $product = $setup->getConnection()
            ->newTable($setup->getTable('tychons_storeorder_product'))
            ->addColumn(
                'storeproduct_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'storeproduct_id'
            )
            ->addColumn(
                'product_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'product_id'
            )
            ->addColumn(
                'product_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'product_name'
            )
            ->addColumn(
                'product_price',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'product_price'
            )
            ->addColumn(
                'product_url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'product_price'
            )
            ->addColumn(
                'qty',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'qty'
            )
            ->addColumn(
                'total_price',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'total_price'
            )
            ->addColumn(
                'product_image',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'product_image'
            )
            ->addColumn(
                'owner',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'owner'
            )->addColumn(
                'sku',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'sku'
            )->addColumn(
                'desc',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'desc'
            )->setComment("Greeting Message table");
        $setup->getConnection()->createTable($product);
    }
}
