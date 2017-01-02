<?php
use Migrations\AbstractMigration;

class SkipActs extends AbstractMigration
{

    public function up()
    {
        $this->table('albums')
            ->addColumn('hide_from_acts', 'boolean', ['default' => '0', 'length' => null, 'null' => true])
            ->update();

        $this->table('notes')
            ->addColumn('hide_from_acts', 'boolean', ['default' => '0', 'length' => null, 'null' => true])
            ->update();

        $this->table('posts')
            ->addColumn('hide_from_acts', 'boolean', ['default' => '0', 'length' => null, 'null' => true])
            ->update();

        $this->table('projects')
            ->addColumn('hide_from_acts', 'boolean', ['default' => '0', 'length' => null, 'null' => true])
            ->update();
    }

    public function down()
    {
        $this->table('albums')
            ->removeColumn('hide_from_acts')
            ->update();

        $this->table('notes')
            ->removeColumn('hide_from_acts')
            ->update();

        $this->table('posts')
            ->removeColumn('hide_from_acts')
            ->update();

        $this->table('projects')
            ->removeColumn('hide_from_acts')
            ->update();
    }
}

