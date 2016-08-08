<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ActComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ActComponent Test Case
 */
class ActComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ActComponent
     */
    public $ActComponent;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ActComponent = new ActComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActComponent);

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
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test remove method
     *
     * @return void
     */
    public function testRemove()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test removeAll method
     *
     * @return void
     */
    public function testRemoveAll()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
