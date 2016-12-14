<?php
use Migrations\AbstractMigration;

class CreateAlbums extends AbstractMigration
{

    public function up()
    {

        $this->table('albums', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('sfw', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('status', 'integer', [
                'default' => 0,
                'limit' => 1,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('language_id', 'string', [
                'default' => null,
                'limit' => 3,
                'null' => false,
            ])
            ->addIndex(
                [
                    'language_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('albums_files')
            ->addColumn('album_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('file_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'album_id',
                ]
            )
            ->addIndex(
                [
                    'file_id',
                ]
            )
            ->create();

        $this->table('projects_albums')
            ->addColumn('project_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('album_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'album_id',
                ]
            )
            ->addIndex(
                [
                    'project_id',
                ]
            )
            ->create();

        $this->table('albums')
            ->addForeignKey(
                'language_id',
                'languages',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('albums_files')
            ->addForeignKey(
                'album_id',
                'albums',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'file_id',
                'files',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('projects_albums')
            ->addForeignKey(
                'album_id',
                'albums',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'project_id',
                'projects',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('files')
            ->addColumn('hide_from_acts', 'boolean', [
                'default' => 0,
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('languages')
            ->addColumn('album_count', 'integer', [
                'default' => 0,
                'length' => 5,
                'null' => false,
            ])
            ->update();

        $this->table('users')
            ->addColumn('album_count', 'integer', [
                'default' => 0,
                'length' => 5,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {
        $this->table('albums')
            ->dropForeignKey(
                'language_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('albums_files')
            ->dropForeignKey(
                'album_id'
            )
            ->dropForeignKey(
                'file_id'
            );

        $this->table('projects_albums')
            ->dropForeignKey(
                'album_id'
            )
            ->dropForeignKey(
                'project_id'
            );

        $this->table('files')
            ->removeColumn('hide_from_acts')
            ->update();

        $this->table('languages')
            ->removeColumn('album_count')
            ->update();

        $this->table('users')
            ->removeColumn('album_count')
            ->update();

        $this->dropTable('albums');

        $this->dropTable('albums_files');

        $this->dropTable('projects_albums');
    }
}

