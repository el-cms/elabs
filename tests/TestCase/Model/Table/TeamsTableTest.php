<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TeamsTable Test Case
 */
class TeamsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamsTable
     */
    public $TeamsTable;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teams',
        'app.projects',
        'app.licenses',
        'app.files',
        'app.languages',
        'app.notes',
        'app.users',
        'app.posts',
        'app.tags',
        'app.files_tags',
        'app.notes_tags',
        'app.posts_tags',
        'app.projects_tags',
        'app.projects_posts',
        'app.acts',
        'app.reports',
        'app.teams_users',
        'app.projects_notes',
        'app.projects_files',
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
        $config = TableRegistry::exists('Teams') ? [] : ['className' => 'App\Model\Table\TeamsTable'];
        $this->TeamsTable = TableRegistry::get('Teams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TeamsTable);

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
}
