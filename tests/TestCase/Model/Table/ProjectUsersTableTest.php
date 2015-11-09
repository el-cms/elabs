<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectUsersTable Test Case
 */
class ProjectUsersTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.project_users',
        'app.users',
        'app.acts',
        'app.files',
        'app.licenses',
        'app.posts',
        'app.projects',
        'app.itemfiles',
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
        $config = TableRegistry::exists('ProjectUsers') ? [] : ['className' => 'App\Model\Table\ProjectUsersTable'];
        $this->ProjectUsers = TableRegistry::get('ProjectUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectUsers);

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
