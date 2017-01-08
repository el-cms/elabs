<?php

use Migrations\AbstractMigration;

class UpdateTags extends AbstractMigration
{

    public function up()
    {
        $this->table('files_tags')
                ->dropForeignKey('file_id')
                ->dropForeignKey('tag_id');
        $this->table('notes_tags')
                ->dropForeignKey('note_id')
                ->dropForeignKey('tag_id');
        $this->table('posts_tags')
                ->dropForeignKey('post_id')
                ->dropForeignKey('tag_id');
        $this->table('projects_tags')
                ->dropForeignKey('project_id')
                ->dropForeignKey('tag_id');

        $this->table('tags')
                ->removeColumn('name')
                ->removeColumn('itemtag_count')
                ->changeColumn('id', 'string', ['default' => null, 'limit' => 15, 'null' => false])
                ->update();

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

        $this->table('albums_tags',  ['id' => false, 'primary_key' => ['id']])
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
        $this->table('files_tags')
                ->addForeignKey('file_id', 'files', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();
        $this->table('notes_tags')
                ->addForeignKey('note_id', 'notes', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();
        $this->table('posts_tags')
                ->addForeignKey('post_id', 'posts', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();
        $this->table('projects_tags')
                ->addForeignKey('project_id', 'projects', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();
    }

    public function down()
    {
        $this->table('albums_tags')
                ->dropForeignKey('album_id')
                ->dropForeignKey('tag_id');
        $this->table('files_tags')
                ->dropForeignKey('file_id')
                ->dropForeignKey('tag_id');
        $this->table('notes_tags')
                ->dropForeignKey('note_id')
                ->dropForeignKey('tag_id');
        $this->table('posts_tags')
                ->dropForeignKey('post_id')
                ->dropForeignKey('tag_id');
        $this->table('projects_tags')
                ->dropForeignKey('project_id')
                ->dropForeignKey('tag_id');

        $this->table('tags')
                ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => true])
                ->addColumn('itemtag_count', 'integer', ['default' => 0, 'limit' => 5, 'null' => false])
                ->changeColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'length' => 5, 'null' => false])
                ->update();

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

        $this->dropTable('albums_tags');

        $this->table('files_tags')
                ->addForeignKey('file_id', 'files', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();
        $this->table('notes_tags')
                ->addForeignKey('note_id', 'notes', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();
        $this->table('posts_tags')
                ->addForeignKey('post_id', 'posts', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();
        $this->table('projects_tags')
                ->addForeignKey('project_id', 'projects', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();
    }
}
