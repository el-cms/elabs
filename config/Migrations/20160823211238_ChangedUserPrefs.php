<?php

namespace Migrations;

use Migrations\AbstractMigration;

class ChangedUserPrefs extends AbstractMigration
{
    /**
     * Updates the tables in db
     *
     * @return void
     */
    public function up()
    {
        $this->table('users')
            ->removeColumn('see_nsfw')
            ->update();
    }

    /**
     * Rollback changes
     *
     * @return void
     */
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
