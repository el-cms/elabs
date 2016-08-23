<?php
use Migrations\AbstractMigration;

class ChangedUserPrefs extends AbstractMigration
{

    public function up()
    {

        $this->table('users')
            ->removeColumn('see_nsfw')
            ->update();
    }

    public function down()
    {

        $this->table('users')
            ->addColumn('see_nsfw', 'boolean', [
                'default' => 0,
                'length' => null,
                'null' => false,
            ])
            ->update();
    }
}

