<?php
use Migrations\AbstractMigration;

class NotesUpdate extends AbstractMigration
{

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

    public function down()
    {

        $this->table('notes')
            ->removeColumn('created')
            ->removeColumn('modified')
            ->update();
    }
}

