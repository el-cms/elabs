<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActsTable;
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
    public $Acts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.acts'
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
        $this->Acts = TableRegistry::get('Acts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Acts);

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
