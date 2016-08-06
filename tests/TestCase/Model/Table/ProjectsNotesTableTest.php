<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectsNotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectsNotesTable Test Case
 */
class ProjectsNotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectsNotesTable
     */
    public $ProjectsNotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projects_notes',
        'app.projects',
        'app.licenses',
        'app.files',
        'app.languages',
        'app.notes',
        'app.users',
        'app.posts',
        'app.tags',
        'app.posts_tags',
        'app.projects_posts',
        'app.reports',
        'app.teams',
        'app.teams_users',
        'app.notes_tags',
        'app.files_tags',
        'app.projects_files',
        'app.projects_tags',
        'app.teams_projects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProjectsNotes') ? [] : ['className' => 'App\Model\Table\ProjectsNotesTable'];
        $this->ProjectsNotes = TableRegistry::get('ProjectsNotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectsNotes);

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
