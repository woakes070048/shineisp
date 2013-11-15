<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('FilesCategories', 'doctrine');

/**
 * BaseFilesCategories
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $category_id
 * @property string $name
 * @property Doctrine_Collection $Files
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFilesCategories extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('files_categories');
        $this->hasColumn('category_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('name', 'string', 200, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '200',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Files', array(
             'local' => 'category_id',
             'foreign' => 'category_id'));
    }
}