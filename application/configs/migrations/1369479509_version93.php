<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version93 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->removeColumn('customers', 'language');
        $this->removeColumn('oauth_access_tokens', 'user_id');
        $this->removeColumn('oauth_authorization_codes', 'user_id');
        $this->removeColumn('oauth_refresh_tokens', 'user_id');
        $this->addColumn('customers', 'language_id', 'integer', '4', array(
             'default' => '1',
             'notnull' => '',
             ));
        $this->addColumn('domains_tlds', 'autosetup', 'integer', '4', array(
             'unsigned' => '1',
             'notnull' => '1',
             'default' => '0',
             ));
        $this->addColumn('oauth_access_tokens', 'customer_id', 'integer', '4', array(
             'notnull' => '1',
             ));
        $this->addColumn('oauth_authorization_codes', 'customer_id', 'integer', '4', array(
             'notnull' => '1',
             ));
        $this->addColumn('oauth_clients', 'customer_id', 'integer', '4', array(
             'notnull' => '1',
             ));
        $this->addColumn('oauth_clients', 'app_name', 'string', '250', array(
             'notnull' => '1',
             ));
        $this->addColumn('oauth_refresh_tokens', 'customer_id', 'integer', '4', array(
             'notnull' => '1',
             ));
    }

    public function down()
    {
        $this->addColumn('customers', 'language', 'string', '5', array(
             'notnull' => '',
             ));
        $this->addColumn('oauth_access_tokens', 'user_id', 'integer', '4', array(
             'notnull' => '1',
             ));
        $this->addColumn('oauth_authorization_codes', 'user_id', 'integer', '4', array(
             'notnull' => '1',
             ));
        $this->addColumn('oauth_refresh_tokens', 'user_id', 'integer', '4', array(
             'notnull' => '1',
             ));
        $this->removeColumn('customers', 'language_id');
        $this->removeColumn('domains_tlds', 'autosetup');
        $this->removeColumn('oauth_access_tokens', 'customer_id');
        $this->removeColumn('oauth_authorization_codes', 'customer_id');
        $this->removeColumn('oauth_clients', 'customer_id');
        $this->removeColumn('oauth_clients', 'app_name');
        $this->removeColumn('oauth_refresh_tokens', 'customer_id');
    }
}