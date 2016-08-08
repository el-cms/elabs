<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LicensesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LicensesTable Test Case
 */
class LicensesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LicensesTable
     */
    public $Licenses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.licenses',
        'app.files',
        'app.languages',
        'app.notes',
        'app.posts',
        'app.projects',
        'app.users',
        'app.reports',
        'app.teams',
        'app.teams_users',
        'app.tags',
        'app.files_tags',
        'app.projects_files'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Licenses') ? [] : ['className' => 'App\Model\Table\LicensesTable'];
        $this->Licenses = TableRegistry::get('Licenses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Licenses);

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
