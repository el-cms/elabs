<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotesTagsFixture
 *
 */
class NotesTagsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'note_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'tag_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_notes_has_tags_tags1_idx' => ['type' => 'index', 'columns' => ['tag_id'], 'length' => []],
            'fk_notes_has_tags_notes1_idx' => ['type' => 'index', 'columns' => ['note_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_notes_has_tags_notes1' => ['type' => 'foreign', 'columns' => ['note_id'], 'references' => ['notes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_notes_has_tags_tags1' => ['type' => 'foreign', 'columns' => ['tag_id'], 'references' => ['tags', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'note_id' => '6dd66e2b-60a3-4611-bf0a-41fc2b50c10c',
            'tag_id' => 1
        ],
    ];
}
