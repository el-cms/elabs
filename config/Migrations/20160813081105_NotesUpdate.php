<?php

use Migrations\AbstractMigration;

class NotesUpdate extends AbstractMigration
{
    /**
     * Updates the tables in db
     *
     * @return void
     */
    public function up()
    {
        $this->table('notes')
            ->addColumn('created', 'datetime', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();
    }

    /**
     * Rollback changes
     *
     * @return void
     */
    public function down()
    {
        $this->table('notes')
            ->removeColumn('created')
            ->removeColumn('modified')
            ->update();
    }
}
