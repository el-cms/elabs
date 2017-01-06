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
                ->changeColumn('id', 'string', ['default' => null, 'limit' => 15, 'null' => false])
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
                ->addColumn('name', 'string', ['after' => 'id', 'default' => null, 'length' => 50, 'null' => true])
                ->changeColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'length' => 5, 'null' => false])
                ->update();
    }
}
