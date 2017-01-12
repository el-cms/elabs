<?php

use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public $autoId = false;

    public function up()
    {

        $this->table('acts')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('model', 'string', ['default' => null, 'limit' => 30, 'null' => false,])
                ->addColumn('fkid', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('type', 'string', ['default' => null, 'limit' => 30, 'null' => false,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->create();

        $this->table('albums')
                ->addColumn('id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => false,])
                ->addColumn('description', 'text', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('sfw', 'boolean', ['default' => false, 'limit' => null, 'null' => false,])
                ->addColumn('status', 'integer', ['default' => '0', 'limit' => 1, 'null' => false,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('hide_from_acts', 'boolean', ['default' => false, 'limit' => null, 'null' => true,])
                ->addColumn('user_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('language_id', 'string', ['default' => null, 'limit' => 3, 'null' => false,])
                ->addIndex(['language_id',])
                ->addIndex(['user_id',])
                ->create();

        $this->table('albums_files')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('album_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('file_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addIndex(['album_id',])
                ->addIndex(['file_id',])
                ->create();

        $this->table('albums_tags')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('album_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false,])
                ->addIndex(['album_id',])
                ->addIndex(['tag_id',])
                ->create();

        $this->table('comments')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false,])
                ->addColumn('email', 'string', ['default' => null, 'limit' => 45, 'null' => false,])
                ->addColumn('allow_contact', 'boolean', ['default' => false, 'limit' => null, 'null' => false,])
                ->addColumn('model', 'string', ['default' => null, 'limit' => 30, 'null' => false,])
                ->addColumn('fkid', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('message', 'text', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('user_id', 'uuid', ['default' => null, 'limit' => null, 'null' => true,])
                ->addIndex(['user_id',])
                ->create();

        $this->table('files')
                ->addColumn('id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => true,])
                ->addColumn('filename', 'string', ['default' => null, 'limit' => 255, 'null' => false,])
                ->addColumn('weight', 'integer', ['default' => null, 'limit' => 11, 'null' => false,])
                ->addColumn('description', 'text', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('mime', 'string', ['default' => null, 'limit' => 50, 'null' => true,])
                ->addColumn('sfw', 'boolean', ['default' => false, 'limit' => null, 'null' => false,])
                ->addColumn('status', 'integer', ['default' => '0', 'limit' => 1, 'null' => false,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('hide_from_acts', 'boolean', ['default' => false, 'limit' => null, 'null' => false,])
                ->addColumn('language_id', 'string', ['default' => null, 'limit' => 3, 'null' => false,])
                ->addColumn('license_id', 'integer', ['default' => null, 'limit' => 3, 'null' => false, 'signed' => false,])
                ->addColumn('user_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addIndex(['language_id',])
                ->addIndex(['license_id',])
                ->addIndex(['user_id',])
                ->create();

        $this->table('files_tags')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('file_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false,])
                ->addIndex(['file_id',])
                ->addIndex(['tag_id',])
                ->create();

        $this->table('languages')
                ->addColumn('id', 'string', ['default' => null, 'limit' => 3, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('iso639_1', 'string', ['default' => null, 'limit' => 2, 'null' => false,])
                ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false,])
                ->addColumn('has_site_translation', 'boolean', ['default' => false, 'limit' => null, 'null' => false,])
                ->addColumn('translation_folder', 'string', ['default' => null, 'limit' => 7, 'null' => true,])
                ->addColumn('album_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('file_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('note_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('post_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('project_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->create();

        $this->table('licenses')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 3, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => false,])
                ->addColumn('link', 'string', ['default' => null, 'limit' => 150, 'null' => true,])
                ->addColumn('icon', 'string', ['default' => null, 'limit' => 20, 'null' => true,])
                ->addColumn('file_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('note_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('post_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('project_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->create();

        $this->table('notes')
                ->addColumn('id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('text', 'string', ['default' => null, 'limit' => 255, 'null' => false,])
                ->addColumn('sfw', 'boolean', ['default' => false, 'limit' => null, 'null' => false,])
                ->addColumn('status', 'integer', ['default' => '0', 'limit' => 1, 'null' => false,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('hide_from_acts', 'boolean', ['default' => false, 'limit' => null, 'null' => true,])
                ->addColumn('user_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('language_id', 'string', ['default' => null, 'limit' => 3, 'null' => false,])
                ->addColumn('license_id', 'integer', ['default' => null, 'limit' => 3, 'null' => false, 'signed' => false,])
                ->addIndex(['language_id',])
                ->addIndex(['license_id',])
                ->addIndex(['user_id',])
                ->create();

        $this->table('notes_tags')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('note_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false,])
                ->addIndex(['note_id',])
                ->addIndex(['tag_id',])
                ->create();

        $this->table('posts')
                ->addColumn('id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('title', 'string', ['default' => null, 'limit' => 50, 'null' => true,])
                ->addColumn('excerpt', 'string', ['default' => null, 'limit' => 255, 'null' => false,])
                ->addColumn('text', 'text', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('sfw', 'boolean', ['default' => false, 'limit' => null, 'null' => false,])
                ->addColumn('status', 'integer', ['default' => '0', 'limit' => 1, 'null' => false,])
                ->addColumn('publication_date', 'datetime', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('hide_from_acts', 'boolean', ['default' => false, 'limit' => null, 'null' => true,])
                ->addColumn('user_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('license_id', 'integer', ['default' => null, 'limit' => 3, 'null' => false, 'signed' => false,])
                ->addColumn('language_id', 'string', ['default' => null, 'limit' => 3, 'null' => false,])
                ->addIndex(['language_id',])
                ->addIndex(['license_id',])
                ->addIndex(['user_id',])
                ->create();

        $this->table('posts_tags')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('post_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false,])
                ->addIndex(['post_id',])
                ->addIndex(['tag_id',])
                ->create();

        $this->table('projects')
                ->addColumn('id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => true,])
                ->addColumn('short_description', 'string', ['default' => null, 'limit' => 255, 'null' => true,])
                ->addColumn('description', 'text', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('mainurl', 'string', ['default' => null, 'limit' => 150, 'null' => true,])
                ->addColumn('sfw', 'boolean', ['default' => false, 'limit' => null, 'null' => false,])
                ->addColumn('status', 'integer', ['default' => '0', 'limit' => 1, 'null' => false,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('hide_from_acts', 'boolean', ['default' => false, 'limit' => null, 'null' => true,])
                ->addColumn('album_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('file_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('note_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('post_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('language_id', 'string', ['default' => null, 'limit' => 3, 'null' => false,])
                ->addColumn('license_id', 'integer', ['default' => null, 'limit' => 3, 'null' => false, 'signed' => false,])
                ->addColumn('user_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addIndex(['language_id',])
                ->addIndex(['license_id',])
                ->addIndex(['user_id',])
                ->create();

        $this->table('projects_albums')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('project_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('album_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addIndex(['album_id',])
                ->addIndex(['project_id',])
                ->create();

        $this->table('projects_files')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('project_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('file_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addIndex(['file_id',])
                ->addIndex(['project_id',])
                ->create();

        $this->table('projects_notes')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('project_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('note_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addIndex(['note_id',])
                ->addIndex(['project_id',])
                ->create();

        $this->table('projects_posts')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('project_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('post_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addIndex(['post_id',])
                ->addIndex(['project_id',])
                ->create();

        $this->table('projects_tags')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('project_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('tag_id', 'string', ['default' => null, 'limit' => 15, 'null' => false,])
                ->addIndex(['project_id',])
                ->addIndex(['tag_id',])
                ->create();

        $this->table('reports')
                ->addColumn('id', 'integer', ['autoIncrement' => true, 'default' => null, 'limit' => 5, 'null' => false, 'signed' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => true,])
                ->addColumn('email', 'string', ['default' => null, 'limit' => 45, 'null' => true,])
                ->addColumn('url', 'string', ['default' => null, 'limit' => 255, 'null' => false,])
                ->addColumn('reason', 'text', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('session', 'text', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('user_id', 'uuid', ['default' => null, 'limit' => null, 'null' => true,])
                ->addIndex(['user_id',])
                ->create();

        $this->table('social_accounts')
                ->addColumn('id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('user_id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('provider', 'string', ['default' => null, 'limit' => 255, 'null' => false,])
                ->addColumn('username', 'string', ['default' => null, 'limit' => 255, 'null' => true,])
                ->addColumn('reference', 'string', ['default' => null, 'limit' => 255, 'null' => false,])
                ->addColumn('avatar', 'string', ['default' => null, 'limit' => 255, 'null' => true,])
                ->addColumn('description', 'text', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('link', 'string', ['default' => null, 'limit' => 255, 'null' => false,])
                ->addColumn('token', 'string', ['default' => null, 'limit' => 500, 'null' => false,])
                ->addColumn('token_secret', 'string', ['default' => null, 'limit' => 500, 'null' => true,])
                ->addColumn('token_expires', 'datetime', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('active', 'boolean', ['default' => true, 'limit' => null, 'null' => false,])
                ->addColumn('data', 'text', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addIndex(['user_id',])
                ->create();

        $this->table('tags')
                ->addColumn('id', 'string', ['default' => null, 'limit' => 15, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('album_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('file_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('note_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('post_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('project_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->create();

        $this->table('users')
                ->addColumn('id', 'uuid', ['default' => null, 'limit' => null, 'null' => false,])
                ->addPrimaryKey(['id'])
                ->addColumn('email', 'string', ['default' => null, 'limit' => 255, 'null' => false,])
                ->addColumn('username', 'string', ['default' => null, 'limit' => 32, 'null' => false,])
                ->addColumn('first_name', 'string', ['default' => null, 'limit' => 50, 'null' => true,])
                ->addColumn('last_name', 'string', ['default' => null, 'limit' => 50, 'null' => true,])
                ->addColumn('password', 'string', ['default' => null, 'limit' => 255, 'null' => false,])
                ->addColumn('website', 'string', ['default' => null, 'limit' => 150, 'null' => true,])
                ->addColumn('bio', 'text', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('preferences', 'text', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false,])
                ->addColumn('active', 'integer', ['default' => '0', 'limit' => 1, 'null' => false,])
                ->addColumn('role', 'string', ['default' => 'author', 'limit' => 255, 'null' => true,])
                ->addColumn('album_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('file_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('note_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('post_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('project_count', 'integer', ['default' => '0', 'limit' => 5, 'null' => false,])
                ->addColumn('token', 'string', ['default' => null, 'limit' => 255, 'null' => true,])
                ->addColumn('token_expires', 'datetime', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('api_token', 'string', ['default' => null, 'limit' => 255, 'null' => true,])
                ->addColumn('activation_date', 'datetime', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('tos_date', 'datetime', ['default' => null, 'limit' => null, 'null' => true,])
                ->addColumn('is_superuser', 'boolean', ['default' => false, 'limit' => null, 'null' => false,])
                ->create();

        $this->table('albums')
                ->addForeignKey('language_id', 'languages', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('albums_files')
                ->addForeignKey('album_id', 'albums', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('file_id', 'files', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('albums_tags')
                ->addForeignKey('album_id', 'albums', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('comments')
                ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('files')
                ->addForeignKey('language_id', 'languages', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('license_id', 'licenses', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('files_tags')
                ->addForeignKey('file_id', 'files', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('notes')
                ->addForeignKey('language_id', 'languages', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('license_id', 'licenses', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('notes_tags')
                ->addForeignKey('note_id', 'notes', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('posts')
                ->addForeignKey('language_id', 'languages', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('license_id', 'licenses', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('posts_tags')
                ->addForeignKey('post_id', 'posts', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('projects')
                ->addForeignKey('language_id', 'languages', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('license_id', 'licenses', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('projects_albums')
                ->addForeignKey('album_id', 'albums', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('project_id', 'projects', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('projects_files')
                ->addForeignKey('file_id', 'files', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('project_id', 'projects', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('projects_notes')
                ->addForeignKey('note_id', 'notes', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('project_id', 'projects', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('projects_posts')
                ->addForeignKey('post_id', 'posts', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('project_id', 'projects', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('projects_tags')
                ->addForeignKey('project_id', 'projects', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->addForeignKey('tag_id', 'tags', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('reports')
                ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
                ->update();

        $this->table('social_accounts')
                ->addForeignKey('user_id', 'users', 'id', ['update' => 'CASCADE', 'delete' => 'CASCADE'])
                ->update();
    }

    public function down()
    {
        $this->table('albums')
                ->dropForeignKey('language_id')
                ->dropForeignKey('user_id');

        $this->table('albums_files')
                ->dropForeignKey('album_id')
                ->dropForeignKey('file_id');

        $this->table('albums_tags')
                ->dropForeignKey('album_id')
                ->dropForeignKey('tag_id');

        $this->table('comments')
                ->dropForeignKey('user_id');

        $this->table('files')
                ->dropForeignKey('language_id')
                ->dropForeignKey('license_id')
                ->dropForeignKey('user_id');

        $this->table('files_tags')
                ->dropForeignKey('file_id')
                ->dropForeignKey('tag_id');

        $this->table('notes')
                ->dropForeignKey('language_id')
                ->dropForeignKey('license_id')
                ->dropForeignKey('user_id');

        $this->table('notes_tags')
                ->dropForeignKey('note_id')
                ->dropForeignKey('tag_id');

        $this->table('posts')
                ->dropForeignKey('language_id')
                ->dropForeignKey('license_id')
                ->dropForeignKey('user_id');

        $this->table('posts_tags')
                ->dropForeignKey('post_id')
                ->dropForeignKey('tag_id');

        $this->table('projects')
                ->dropForeignKey('language_id')
                ->dropForeignKey('license_id')
                ->dropForeignKey('user_id');

        $this->table('projects_albums')
                ->dropForeignKey('album_id')
                ->dropForeignKey('project_id');

        $this->table('projects_files')
                ->dropForeignKey('file_id')
                ->dropForeignKey('project_id');

        $this->table('projects_notes')
                ->dropForeignKey('note_id')
                ->dropForeignKey('project_id');

        $this->table('projects_posts')
                ->dropForeignKey('post_id')
                ->dropForeignKey('project_id');

        $this->table('projects_tags')
                ->dropForeignKey('project_id')
                ->dropForeignKey('tag_id');

        $this->table('reports')
                ->dropForeignKey('user_id');

        $this->table('social_accounts')
                ->dropForeignKey('user_id');

        $this->dropTable('acts');
        $this->dropTable('albums');
        $this->dropTable('albums_files');
        $this->dropTable('albums_tags');
        $this->dropTable('comments');
        $this->dropTable('files');
        $this->dropTable('files_tags');
        $this->dropTable('languages');
        $this->dropTable('licenses');
        $this->dropTable('notes');
        $this->dropTable('notes_tags');
        $this->dropTable('posts');
        $this->dropTable('posts_tags');
        $this->dropTable('projects');
        $this->dropTable('projects_albums');
        $this->dropTable('projects_files');
        $this->dropTable('projects_notes');
        $this->dropTable('projects_posts');
        $this->dropTable('projects_tags');
        $this->dropTable('reports');
        $this->dropTable('social_accounts');
        $this->dropTable('tags');
        $this->dropTable('users');
    }
}
