<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectsFilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectsFilesTable Test Case
 */
class ProjectsFilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectsFilesTable
     */
    public $ProjectsFiles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projects_files',
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
        'app.projects_notes',
        'app.files_tags',
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
        $config = TableRegistry::exists('ProjectsFiles') ? [] : ['className' => 'App\Model\Table\ProjectsFilesTable'];
        $this->ProjectsFiles = TableRegistry::get('ProjectsFiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectsFiles);

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
