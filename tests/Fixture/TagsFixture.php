<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TagsFixture
 *
 */
class TagsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'string', 'length' => 15, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'album_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'file_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'note_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'post_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'project_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'id' => 'new tag',
            'album_count' => 0,
            'file_count' => 1,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'random name',
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 1,
            'project_count' => 0
        ],
        [
            'id' => 'tag1',
            'album_count' => 1,
            'file_count' => 2,
            'note_count' => 1,
            'post_count' => 1,
            'project_count' => 1
        ],
        [
            'id' => 'tag2',
            'album_count' => 1,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 1
        ],
        [
            'id' => 'tag3',
            'album_count' => 1,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
    ];
}
