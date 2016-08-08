<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsNotesFixture
 *
 */
class ProjectsNotesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'project_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'note_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_projects_has_notes_notes1_idx' => ['type' => 'index', 'columns' => ['note_id'], 'length' => []],
            'fk_projects_has_notes_projects1_idx' => ['type' => 'index', 'columns' => ['project_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_projects_has_notes_notes1' => ['type' => 'foreign', 'columns' => ['note_id'], 'references' => ['notes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_projects_has_notes_projects1' => ['type' => 'foreign', 'columns' => ['project_id'], 'references' => ['projects', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'project_id' => '712d9a69-b3d0-4f16-b799-ef940ef61241',
            'note_id' => '6b1c9be8-543d-4717-abd4-eee2290eb3a4'
        ],
    ];
}
