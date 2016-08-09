<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FilesFixture
 *
 */
class FilesFixture extends TestFixture
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
        'filename' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'weight' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'mime' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sfw' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'status' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'language_id' => ['type' => 'string', 'length' => 3, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'license_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'language_id' => ['type' => 'index', 'columns' => ['language_id'], 'length' => []],
            'license_id' => ['type' => 'index', 'columns' => ['license_id'], 'length' => []],
            'user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'files_ibfk_1' => ['type' => 'foreign', 'columns' => ['language_id'], 'references' => ['languages', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'files_ibfk_2' => ['type' => 'foreign', 'columns' => ['license_id'], 'references' => ['licenses', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'files_ibfk_3' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id' => '4aa59eb5-35c6-42c1-91e2-f8c6a6cb8539',
            'name' => 'experimelabs.sql',
            'filename' => '/2016/08/1470703682.sql',
            'weight' => 1438787,
            'description' => 'Some sql file',
            'mime' => 'application/sql',
            'sfw' => true,
            'status' => 1,
            'created' => '2016-08-09 00:48:02',
            'modified' => '2016-08-09 00:48:02',
            'language_id' => 'eng',
            'license_id' => 1,
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685'
        ],
        [
            'id' => '63c22253-9f07-41de-abcf-c9e0a9eaf7e9',
            'name' => 'a4LVpvy_460sv.mp4',
            'filename' => '/2016/08/1470703636.mp4',
            'weight' => 398596,
            'description' => 'A safe video',
            'mime' => 'video/mp4',
            'sfw' => true,
            'status' => 1,
            'created' => '2016-08-09 00:47:16',
            'modified' => '2016-08-09 00:47:16',
            'language_id' => 'fra',
            'license_id' => 1,
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685'
        ],
        [
            'id' => 'cafc0f93-d435-468e-afc7-30a38ee811eb',
            'name' => '37985.gif',
            'filename' => '/2016/08/1470703605.gif',
            'weight' => 1854775,
            'description' => 'An unsafe file',
            'mime' => 'image/gif',
            'sfw' => false,
            'status' => 1,
            'created' => '2016-08-09 00:46:45',
            'modified' => '2016-08-09 00:46:45',
            'language_id' => 'fra',
            'license_id' => 1,
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685'
        ],
    ];
}
