<?php

use Migrations\AbstractMigration;

class CakeDCUser extends AbstractMigration
{
    public $autoId = false;

    /**
     * Creates the tables in db
     *
     * @return void
     */
    public function up()
    {
        $this->table('users')
            ->renameColumn('status', 'active')
            ->removeColumn('realname')
            ->changeColumn('role', 'string', ['default'=>'author', 'null'=>true,])
            ->changeColumn('preferences', 'text', ['null'=>true,])
            ->addColumn('first_name', 'string', ['default' => null, 'limit' => 50, 'null' => true,])
            ->addColumn('last_name', 'string', ['default' => null, 'limit' => 50, 'null' => true,])
            ->addColumn('token', 'string', ['default' => null, 'limit' => 255, 'null' => true,])
            ->addColumn('token_expires', 'datetime', ['default' => null, 'null' => true,])
            ->addColumn('api_token', 'string', ['default' => null, 'limit' => 255, 'null' => true,])
            ->addColumn('activation_date', 'datetime', ['default' => null, 'null' => true,])
            ->addColumn('tos_date', 'datetime', ['default' => null, 'null' => true,])
            ->addColumn('is_superuser', 'boolean', ['default' => false, 'null' => false,])
            ->update();

        $this->table('social_accounts')
            ->addColumn('id', 'uuid', ['null' => false,])
            ->addColumn('user_id', 'uuid', ['null' => false,])
            ->addColumn('provider', 'string', ['limit' => 255, 'null' => false,])
            ->addColumn('username', 'string', ['default' => null, 'limit' => 255, 'null' => true,])
            ->addColumn('reference', 'string', ['limit' => 255, 'null' => false,])
            ->addColumn('avatar', 'string', ['default' => null, 'limit' => 255, 'null' => true,])
            ->addColumn('description', 'text', ['default' => null, 'null' => true,])
            ->addColumn('link', 'string', ['limit' => 255, 'null' => false,])
            ->addColumn('token', 'string', ['limit' => 500, 'null' => false,])
            ->addColumn('token_secret', 'string', ['default' => null, 'limit' => 500, 'null' => true,])
            ->addColumn('token_expires', 'datetime', ['default' => null, 'null' => true,])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false,])
            ->addColumn('data', 'text', ['null' => false,])
            ->addColumn('created', 'datetime', ['null' => false,])
            ->addColumn('modified', 'datetime', ['null' => false,])
            ->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'))
            ->create();
    }

    /**
     * Reverts changes in db
     *
     * @return void
     */
    public function down()
    {
        $this->table('users')
            ->renameColumn('active', 'status')
            ->addColumn('realname', 'string', ['default' => null, 'length' => 100, 'null' => true,])
            ->changeColumn('role', 'string', ['null'=>false,])
            ->changeColumn('preferences', 'text', ['null'=>true,])
            ->dropColumn('first_name')
            ->dropColumn('last_name')
            ->dropColumn('token')
            ->dropColumn('token_expires')
            ->dropColumn('api_token')
            ->dropColumn('activation_date')
            ->dropColumn('tos_date')
            ->dropColumn('is_superuser');

        $this->table('social_accounts')
            ->dropForeignKey('user_id');

        $this->dropTable('social_accounts');

    }
}
