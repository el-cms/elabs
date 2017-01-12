<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlbumsTagsFixture
 *
 */
class AlbumsTagsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'album_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'tag_id' => ['type' => 'string', 'length' => 15, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'albumstags_album_id' => ['type' => 'index', 'columns' => ['album_id'], 'length' => []],
            'albumstags_tag_id' => ['type' => 'index', 'columns' => ['tag_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'albums_tags_ibfk_1' => ['type' => 'foreign', 'columns' => ['album_id'], 'references' => ['albums', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'albums_tags_ibfk_2' => ['type' => 'foreign', 'columns' => ['tag_id'], 'references' => ['tags', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id' => 1,
            'album_id' => '1727fe48-2825-4fd1-a5a1-357d5bd09531',
            'tag_id' => 'tag1'
        ],
        [
            'id' => 2,
            'album_id' => '1727fe48-2825-4fd1-a5a1-357d5bd09531',
            'tag_id' => 'tag2'
        ],
        [
            'id' => 3,
            'album_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685',
            'tag_id' => 'tag3'
        ],
    ];
}
