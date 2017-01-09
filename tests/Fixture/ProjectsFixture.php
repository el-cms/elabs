<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsFixture
 *
 */
class ProjectsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'short_description' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'mainurl' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sfw' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'status' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'hide_from_acts' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
        'album_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'file_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'note_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'post_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'language_id' => ['type' => 'string', 'length' => 3, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'license_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'projects_language_id' => ['type' => 'index', 'columns' => ['language_id'], 'length' => []],
            'projects_license_id' => ['type' => 'index', 'columns' => ['license_id'], 'length' => []],
            'projects_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'projects_ibfk_1' => ['type' => 'foreign', 'columns' => ['language_id'], 'references' => ['languages', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'projects_ibfk_2' => ['type' => 'foreign', 'columns' => ['license_id'], 'references' => ['licenses', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'projects_ibfk_3' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => '47a35a14-62ac-4f68-b617-01fea96ffa30',
            'name' => 'Aother nice project',
            'short_description' => 'This is a short thing !',
            'description' => 'This is longer.',
            'mainurl' => 'http://another-project.com',
            'sfw' => true,
            'status' => 1,
            'created' => '2016-08-09 00:46:17',
            'modified' => '2016-08-09 00:46:17',
            'hide_from_acts' => false,
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'language_id' => 'eng',
            'license_id' => 1,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
        ],
        [
            'id' => '9a9b6e60-6572-4b47-a161-e37ae81e16a8',
            'name' => 'Very unsafe project',
            'short_description' => 'Some unsafe stuff',
            'description' => 'that\'s _it_',
            'mainurl' => '',
            'sfw' => false,
            'status' => 1,
            'created' => '2016-08-09 00:45:25',
            'modified' => '2016-08-09 00:45:25',
            'hide_from_acts' => false,
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'language_id' => 'epo',
            'license_id' => 4,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
        ],
        [
            'id' => 'e5e2988e-2f1c-4902-ba1a-e0f577413f23',
            'name' => 'A test project',
            'short_description' => '__With a bold desc__',
            'description' => 'This is the description',
            'mainurl' => 'http://example.com',
            'sfw' => true,
            'status' => 1,
            'created' => '2016-08-09 00:44:45',
            'modified' => '2016-08-09 00:44:45',
            'hide_from_acts' => false,
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'language_id' => 'fra',
            'license_id' => 1,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
        ],
    ];
}
