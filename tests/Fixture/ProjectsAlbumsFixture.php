<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsAlbumsFixture
 *
 */
class ProjectsAlbumsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'project_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'album_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'projectsalbums_album_id' => ['type' => 'index', 'columns' => ['album_id'], 'length' => []],
            'projectsalbums_project_id' => ['type' => 'index', 'columns' => ['project_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'projects_albums_ibfk_1' => ['type' => 'foreign', 'columns' => ['album_id'], 'references' => ['albums', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'projects_albums_ibfk_2' => ['type' => 'foreign', 'columns' => ['project_id'], 'references' => ['projects', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'project_id' => '64dde731-2584-41ab-b5b0-ed5f540b054c',
            'album_id' => 'ef105762-3c8d-4065-8cf2-4243705df5f8'
        ],
    ];
}
