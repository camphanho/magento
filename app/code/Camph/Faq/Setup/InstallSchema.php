<?php

namespace Camph\Faq\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Function install
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table_camph_faqgroup = $setup->getConnection()->newTable($setup->getTable('camph_faqgroup'));

        $table_camph_faqgroup->addColumn(
            'faqgroup_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'Entity ID'
        );

        $table_camph_faqgroup->addColumn(
            'groupname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'groupname'
        );


        $table_camph_faqgroup->addColumn(
            'sortorder',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'sortorder'
        );

        $table_camph_faq = $setup->getConnection()->newTable($setup->getTable('camph_faq'));

        $table_camph_faq->addColumn(
            'faq_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'Entity ID'
        );

        $table_camph_faq->addColumn(
            'question',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'question'
        );

        $table_camph_faq->addColumn(
            'answer',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'answer'
        );


        $table_camph_faq->addColumn(
            'sortorder',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'sortorder'
        );
        $table_camph_faq_faqgroup = $setup->getConnection()->newTable($setup->getTable('camph_faq_faqgroup'));
        $table_camph_faq_faqgroup->addColumn(
            'id_faq',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'Faq ID'
        );
        $table_camph_faq_faqgroup->addColumn(
            'id_faqgroup',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'Group ID'
        );
        $table_camph_faq_faqgroup->addForeignKey(
            'fk_faq_id',
            'id_faq',
            'camph_faq',
            'faq_id'
        );
        $table_camph_faq_faqgroup->addForeignKey(
            'fk_faqgroup_id',
            'id_faqgroup',
            'camph_faqgroup',
            'faqgroup_id'
        );
        $setup->getConnection()->createTable($table_camph_faq);
        $setup->getConnection()->createTable($table_camph_faqgroup);
        $setup->getConnection()->createTable($table_camph_faq_faqgroup);
        $setup->endSetup();
    }
}
