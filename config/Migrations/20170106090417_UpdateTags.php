<?php

use Migrations\AbstractMigration;

class UpdateTags extends AbstractMigration
{

    public function up()
    {

        $this->table('files_tags')
                ->changeColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false])
                ->update();

        $this->table('notes_tags')
                ->changeColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false])
                ->update();

        $this->table('posts_tags')
                ->changeColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false])
                ->update();

        $this->table('projects_tags')
                ->changeColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false])
                ->update();

        $this->table('tags')
                ->removeColumn('name')
                ->removeColumn('itemtag_count')
                ->changeColumn('id', 'string', ['default' => null, 'limit' => 15, 'null' => false])
                ->update();

        $this->table('albums_tags')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false])
                ->addPrimaryKey(['id'])
                ->addColumn('album_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false])
                ->addColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false])
                ->addIndex(['album_id'])
                ->addIndex(['tag_id'])
                ->create();

        $this->table('albums_tags')
                ->addForeignKey('album_id', 'albums', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();
    }

    public function down()
    {

        $this->table('files_tags')
                ->changeColumn('tag_id', 'integer', ['default' => null, 'length' => 5, 'null' => false])
                ->update();

        $this->table('notes_tags')
                ->changeColumn('tag_id', 'integer', ['default' => null, 'length' => 5, 'null' => false])
                ->update();

        $this->table('posts_tags')
                ->changeColumn('tag_id', 'integer', ['default' => null, 'length' => 5, 'null' => false])
                ->update();

        $this->table('projects_tags')
                ->changeColumn('tag_id', 'integer', ['default' => null, 'length' => 5, 'null' => false])
                ->update();

        $this->table('tags')
                ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => true])
                ->addColumn('itemtag_count', 'integer', ['default' => 0, 'limit' => 5, 'null' => false])
                ->changeColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'length' => 5, 'null' => false])
                ->update();

        $this->table('albums_tags')
                ->dropForeignKey('album_id')
                ->dropForeignKey('tag_id');

        $this->dropTable('albums_tags');
    }
}
