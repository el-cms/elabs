<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotesTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotesTagsTable Test Case
 */
class NotesTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotesTagsTable
     */
    public $NotesTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notes_tags',
        'app.notes',
        'app.users',
        'app.files',
        'app.languages',
        'app.posts',
        'app.projects',
        'app.licenses',
        'app.tags',
        'app.files_tags',
        'app.projects_files',
        'app.reports',
        'app.teams',
        'app.teams_users',
        'app.projects_notes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NotesTags') ? [] : ['className' => 'App\Model\Table\NotesTagsTable'];
        $this->NotesTags = TableRegistry::get('NotesTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NotesTags);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
