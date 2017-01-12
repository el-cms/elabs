<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotesFixture
 *
 */
class NotesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'text' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sfw' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'status' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'hide_from_acts' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'language_id' => ['type' => 'string', 'length' => 3, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'license_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'notes_language_id' => ['type' => 'index', 'columns' => ['language_id'], 'length' => []],
            'notes_license_id' => ['type' => 'index', 'columns' => ['license_id'], 'length' => []],
            'notes_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'notes_ibfk_1' => ['type' => 'foreign', 'columns' => ['language_id'], 'references' => ['languages', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'notes_ibfk_2' => ['type' => 'foreign', 'columns' => ['license_id'], 'references' => ['licenses', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'notes_ibfk_3' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id' => '70c8fff0-1338-48d2-b93b-942a26eddddd',
            'text' => 'This is note #1',
            'sfw' => false,
            'status' => 1,
            'created' => '2016-08-13 08:13:53',
            'modified' => '2016-08-13 08:13:53',
            'hide_from_acts' => false,
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685',
            'language_id' => 'aar',
            'license_id' => 1
        ],
        [
            'id' => 'c5fba703-fd07-4a1c-b7b0-345a76c36c31',
            'text' => 'This is note #2',
            'sfw' => false,
            'status' => 1,
            'created' => '2016-08-13 08:13:53',
            'modified' => '2016-08-13 09:13:53',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'language_id' => 'aar',
            'license_id' => 1
        ],
        [
            'id' => 'c5fba703-fd07-4a1c-b7b0-345a76c36c32',
            'text' => 'This is note #3',
            'sfw' => true,
            'status' => 2,
            'created' => '2016-08-13 08:13:53',
            'modified' => '2016-08-13 08:13:53',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'language_id' => 'aar',
            'license_id' => 1
        ],
        [
            'id' => 'c5fba703-fd07-4a1c-b7b0-345a76c36c33',
            'text' => 'This is note #4',
            'sfw' => true,
            'status' => 1,
            'created' => '2016-08-13 08:13:53',
            'modified' => '2016-08-13 08:13:53',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'language_id' => 'aar',
            'license_id' => 1
        ],
        [
            'id' => 'c5fba703-fd07-4a1c-b7b0-345a76c36c34',
            'text' => 'This is note #5',
            'sfw' => true,
            'status' => 1,
            'created' => '2016-08-13 08:13:53',
            'modified' => '2016-08-13 08:13:53',
            'hide_from_acts' => false,
            'user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'language_id' => 'aar',
            'license_id' => 1
        ],
    ];
}
