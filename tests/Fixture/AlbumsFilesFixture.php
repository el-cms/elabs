<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlbumsFilesFixture
 *
 */
class AlbumsFilesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'album_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'file_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_albums_has_files_files1_idx' => ['type' => 'index', 'columns' => ['file_id'], 'length' => []],
            'fk_albums_has_files_albums1_idx' => ['type' => 'index', 'columns' => ['album_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_albums_has_files_albums1' => ['type' => 'foreign', 'columns' => ['album_id'], 'references' => ['albums', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_albums_has_files_files1' => ['type' => 'foreign', 'columns' => ['file_id'], 'references' => ['files', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'file_id' => '4aa59eb5-35c6-42c1-91e2-f8c6a6cb8539'
        ],
    ];
}
