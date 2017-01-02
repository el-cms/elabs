<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActsTable Test Case
 */
class ActsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActsTable
     */
    public $ActsTable;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.acts',
        'app.files',
        'app.languages',
        'app.notes',
        'app.users',
        'app.posts',
        'app.licenses',
        'app.projects',
        'app.projects_files',
        'app.projects_notes',
        'app.projects_posts',
        'app.tags',
        'app.files_tags',
        'app.notes_tags',
        'app.posts_tags',
        'app.projects_tags',
        'app.teams',
        'app.teams_projects',
        'app.teams_users',
        'app.reports'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Acts') ? [] : ['className' => 'App\Model\Table\ActsTable'];
        $this->ActsTable = TableRegistry::get('Acts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActsTable);

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
