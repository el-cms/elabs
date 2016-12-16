<?php
use Migrations\AbstractMigration;

class ProjectsAlbumCounter extends AbstractMigration
{

    public function up()
    {
        $this->table('projects')
            ->addColumn('album_count', 'integer', [
                'default' => '0',
                'length' => 5,
                'null' => false,
            ])
            ->addColumn('file_count', 'integer', [
                'default' => '0',
                'length' => 5,
                'null' => false,
            ])
            ->addColumn('note_count', 'integer', [
                'default' => '0',
                'length' => 5,
                'null' => false,
            ])
            ->addColumn('post_count', 'integer', [
                'default' => '0',
                'length' => 5,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {
        $this->table('projects')
            ->removeColumn('album_count')
            ->removeColumn('file_count')
            ->removeColumn('note_count')
            ->removeColumn('post_count')
            ->update();
    }
}

