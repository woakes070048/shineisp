<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('OrdersItemsServers', 'doctrine');

/**
 * BaseOrdersItemsServers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $relationship_id
 * @property int $server_id
 * @property int $order_id
 * @property int $orderitem_id
 * @property Servers $Servers
 * @property Orders $Orders
 * @property OrdersItems $OrdersItems
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrdersItemsServers extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('orders_items_servers');
        $this->hasColumn('relationship_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('server_id', 'int', 4, array(
             'type' => 'int',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('order_id', 'int', 4, array(
             'type' => 'int',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('orderitem_id', 'int', 4, array(
             'type' => 'int',
             'notnull' => true,
             'length' => '4',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Servers', array(
             'local' => 'server_id',
             'foreign' => 'server_id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Orders', array(
             'local' => 'order_id',
             'foreign' => 'order_id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('OrdersItems', array(
             'local' => 'orderitem_id',
             'foreign' => 'detail_id',
             'onDelete' => 'CASCADE'));
    }
}