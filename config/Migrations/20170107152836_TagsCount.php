<?php

use Migrations\AbstractMigration;

class TagsCount extends AbstractMigration
{

    public function up()
    {

        $this->table('tags')
                ->removeColumn('itemtag_count')
                ->update();

        $this->table('tags')
                ->addColumn('album_count', 'integer', ['after' => 'id', 'default' => '0', 'length' => 5, 'null' => false])
                ->addColumn('file_count', 'integer', ['after' => 'file_count', 'default' => '0', 'length' => 5, 'null' => false])
                ->addColumn('note_count', 'integer', ['after' => 'note_count', 'default' => '0', 'length' => 5, 'null' => false])
                ->addColumn('post_count', 'integer', ['after' => 'post_count', 'default' => '0', 'length' => 5, 'null' => false])
                ->addColumn('project_count', 'integer', ['after' => 'project_count', 'default' => '0', 'length' => 5, 'null' => false])
                ->update();
    }

    public function down()
    {

        $this->table('tags')
                ->addColumn('itemtag_count', 'integer', ['after' => 'id', 'default' => '0', 'length' => 5, 'null' => false])
                ->removeColumn('album_count')
                ->removeColumn('file_count')
                ->removeColumn('note_count')
                ->removeColumn('post_count')
                ->removeColumn('project_count')
                ->update();
    }
}
