<?php
namespace Octocub\OneStepCheckout\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class AddDeliveryColumns implements SchemaPatchInterface
{
    public function __construct(private SchemaSetupInterface $schemaSetup) {}

    public function apply()
    {
        $setup = $this->schemaSetup;
        $setup->startSetup();
        $conn = $setup->getConnection();

        foreach (['quote', 'sales_order'] as $tbl) {
            $table = $setup->getTable($tbl);

            if ($conn->isTableExists($table)) {
                if (!$conn->tableColumnExists($table, 'octocub_delivery_date')) {
                    $conn->addColumn($table, 'octocub_delivery_date', [
                        'type' => Table::TYPE_TEXT,
                        'length' => 32,
                        'nullable' => true,
                        'comment' => 'Octocub Delivery Date'
                    ]);
                }
                if (!$conn->tableColumnExists($table, 'octocub_delivery_time')) {
                    $conn->addColumn($table, 'octocub_delivery_time', [
                        'type' => Table::TYPE_TEXT,
                        'length' => 32,
                        'nullable' => true,
                        'comment' => 'Octocub Delivery Time'
                    ]);
                }
            }
        }

        $setup->endSetup();
    }

    public static function getDependencies(): array { return []; }
    public function getAliases(): array { return []; }
}
