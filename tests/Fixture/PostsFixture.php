<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostsFixture
 *
 */
class PostsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'title' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'excerpt' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'text' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'sfw' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'status' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'publication_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'hide_from_acts' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'license_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'language_id' => ['type' => 'string', 'length' => 3, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'posts_language_id' => ['type' => 'index', 'columns' => ['language_id'], 'length' => []],
            'posts_license_id' => ['type' => 'index', 'columns' => ['license_id'], 'length' => []],
            'posts_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'posts_ibfk_1' => ['type' => 'foreign', 'columns' => ['language_id'], 'references' => ['languages', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'posts_ibfk_2' => ['type' => 'foreign', 'columns' => ['license_id'], 'references' => ['licenses', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'posts_ibfk_3' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id' => '6e0c6123-2dbd-47d3-868b-9797cd9f3039',
            'title' => 'Test post',
            'excerpt' => '__SFW__ and published',
            'text' => 'Some text',
            'sfw' => true,
            'status' => 1,
            'publication_date' => '2016-08-09 00:42:25',
            'created' => '2016-08-09 00:42:25',
            'modified' => '2016-08-09 00:42:25',
            'hide_from_acts' => false,
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685',
            'license_id' => 1,
            'language_id' => 'eng'
        ],
        [
            'id' => 'a2e76afd-4624-44a5-b07c-1560f9e7fcec',
            'title' => 'Test post 2',
            'excerpt' => '__SFW__ and draft',
            'text' => '',
            'sfw' => true,
            'status' => 0,
            'publication_date' => null,
            'created' => '2016-08-09 00:43:00',
            'modified' => '2016-08-09 00:43:00',
            'hide_from_acts' => false,
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685',
            'license_id' => 2,
            'language_id' => 'eng'
        ],
        [
            'id' => 'c54a9c9e-670f-46c6-9757-12f35b75ba0d',
            'title' => 'A post from the tester - Draft',
            'excerpt' => 'Intro',
            'text' => 'Content',
            'sfw' => false,
            'status' => 0,
            'publication_date' => null,
            'created' => '2016-08-09 01:20:41',
            'modified' => '2016-08-09 01:20:41',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'license_id' => 1,
            'language_id' => 'eng'
        ],
        [
            'id' => 'd5f4a0fa-2956-465e-ab99-2c975df276b9',
            'title' => 'Some title - published',
            'excerpt' => 'Intro',
            'text' => 'Content',
            'sfw' => true,
            'status' => 1,
            'publication_date' => '2016-08-09 01:21:23',
            'created' => '2016-08-09 01:21:23',
            'modified' => '2016-08-09 03:21:23',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'license_id' => 1,
            'language_id' => 'eng'
        ],
        [
            'id' => 'ed1e1c4a-6edc-4a2b-aaf5-457a3151a13c',
            'title' => 'Test post 3',
            'excerpt' => 'Not published, not safe',
            'text' => '',
            'sfw' => true,
            'status' => 1,
            'publication_date' => null,
            'created' => '2016-08-09 00:43:53',
            'modified' => '2016-08-09 00:43:53',
            'hide_from_acts' => false,
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685',
            'license_id' => 1,
            'language_id' => 'fra'
        ],
        [
            'id' => 'fffe1c4a-6edc-4a2b-aaf5-457a3151a13c',
            'title' => 'Test post 3',
            'excerpt' => 'Not published, not safe',
            'text' => '',
            'sfw' => false,
            'status' => 0,
            'publication_date' => null,
            'created' => '2016-08-09 00:43:53',
            'modified' => '2016-08-09 00:43:53',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'license_id' => 1,
            'language_id' => 'fra'
        ],
        [
            'id' => 'ff1e1c4a-6edc-4a2b-aaf5-457a3151a13c',
            'title' => 'Test post 3',
            'excerpt' => 'Not published, not safe',
            'text' => '',
            'sfw' => false,
            'status' => 1,
            'publication_date' => null,
            'created' => '2016-08-09 00:43:53',
            'modified' => '2016-08-09 00:43:53',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'license_id' => 1,
            'language_id' => 'fra'
        ],
        [
            'id' => 'fd1e1c4a-6edc-4a2b-aaf5-457a3151a13c',
            'title' => 'Test post 3',
            'excerpt' => 'Not published, not safe',
            'text' => '',
            'sfw' => true,
            'status' => 2,
            'publication_date' => null,
            'created' => '2016-08-09 00:43:53',
            'modified' => '2016-08-09 00:43:53',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'license_id' => 1,
            'language_id' => 'fra'
        ],
        [
            'id' => 'fff1c4a-6edc-4a2b-aaf5-457a3151a13c',
            'title' => 'Test post 3',
            'excerpt' => 'Not published, not safe',
            'text' => '',
            'sfw' => false,
            'status' => 3,
            'publication_date' => null,
            'created' => '2016-08-09 00:43:53',
            'modified' => '2016-08-09 00:43:53',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'license_id' => 1,
            'language_id' => 'fra'
        ],
    ];
}
