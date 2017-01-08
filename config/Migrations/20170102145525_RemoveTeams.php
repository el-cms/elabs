<?php
use Migrations\AbstractMigration;

class RemoveTeams extends AbstractMigration
{

    public function up()
    {
        $this->dropTable('teams_projects');

        $this->dropTable('teams_users');

        $this->dropTable('teams');

    }

    public function down()
    {
        $this->table('teams')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false])
                ->addPrimaryKey(['id'])
                ->addColumn('name', 'string', ['default' => null, 'limit' => 100, 'null' => false])
                ->addColumn('description', 'text', ['default' => null, 'limit' => null, 'null' => true])
                ->create();

        $this->table('teams_projects')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false])
                ->addPrimaryKey(['id'])
                ->addColumn('team_id', 'integer', ['default' => null, 'limit' => 5, 'null' => false, 'signed' => false])
                ->addColumn('project_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false])
                ->addIndex(['project_id'])
                ->addIndex(['team_id'])
                ->create();

        $this->table('teams_users')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false])
                ->addPrimaryKey(['id'])
                ->addColumn('team_id', 'integer', ['default' => null, 'limit' => 5, 'null' => false, 'signed' => false])
                ->addColumn('user_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false])
                ->addIndex(['team_id'])
                ->addIndex(['user_id'])
                ->create();
    }
}

