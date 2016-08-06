<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReportsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReportsTable Test Case
 */
class ReportsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReportsTable
     */
    public $Reports;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reports',
        'app.users',
        'app.files',
        'app.languages',
        'app.notes',
        'app.licenses',
        'app.posts',
        'app.tags',
        'app.posts_tags',
        'app.projects',
        'app.projects_files',
        'app.projects_notes',
        'app.projects_posts',
        'app.projects_tags',
        'app.teams',
        'app.teams_projects',
        'app.notes_tags',
        'app.files_tags',
        'app.teams_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Reports') ? [] : ['className' => 'App\Model\Table\ReportsTable'];
        $this->Reports = TableRegistry::get('Reports', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Reports);

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
