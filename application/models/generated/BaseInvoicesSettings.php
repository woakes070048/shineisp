<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('InvoicesSettings', 'doctrine');

/**
 * BaseInvoicesSettings
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $setting_id
 * @property integer $year
 * @property integer $next_number
 * @property integer $isp_id
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInvoicesSettings extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('invoices_settings');
        $this->hasColumn('setting_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('year', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('next_number', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => '4',
             ));
        $this->hasColumn('isp_id', 'integer', 4, array(
             'type' => 'integer',
             'default' => 1,
             'notnull' => true,
             'length' => '4',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}