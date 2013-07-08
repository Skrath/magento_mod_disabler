<?php

$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('disabler/disabledmodule'))
                   ->addColumn('disabledmodule_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                       'unsigned' => true,
                       'nullable' => false,
                       'primary' => true,
                       'identity' => true,
                   ), 'Disabled Module ID')
                   ->addColumn('segment_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                       'unsigned' => true,
                       'nullable' => false,
                       'primary' => false,
                       'identity' => false,
                   ), 'Segment ID')
                   ->addColumn('module_name', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
                       'nullable' => false,
                   ), 'Module Name')
                   ->addForeignKey('FK_disabled_modules_segment', 'segment_id', $installer->getTable('enterprise_customersegment/segment'), 'segment_id' );
/*     ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array( */
/*         'nullable' => false, */
/*         ), 'Blogpost Title') */
/*     ->addColumn('post', Varien_Db_Ddl_Table::TYPE_TEXT, null, array( */
/*         'nullable' => true, */
/*         ), 'Blogpost Body') */
/*     ->addColumn('date', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array( */
/*         ), 'Blogpost Date') */
/*     ->addColumn('timestamp', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array( */
/*         ), 'Timestamp') */
/*     ->setComment('Magentotutorial weblog/blogpost entity table'); */
$installer->getConnection()->createTable($table);

// This is for testing purposes
/* $segment_disable = Mage::getModel('disabler/segmentdisable'); */
/* $blogpost->setSegmentId(1); */
/* $blogpost->setModuleName('BlueAcorn_Obvious'); */
/* $blogpost->save(); */

$installer->endSetup();