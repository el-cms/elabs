<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UpManagerComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UpManagerComponent Test Case
 */
class UpManagerComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\UpManagerComponent
     */
    public $UpManagerComponent;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->UpManagerComponent = new UpManagerComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UpManagerComponent);

        parent::tearDown();
    }

    /**
     * Test makeFileName method
     *
     * @return void
     */
    public function testMakeFileName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test checkFileType method
     *
     * @return void
     */
    public function testCheckFileType()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test checkFileSize method
     *
     * @return void
     */
    public function testCheckFileSize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test preparePath method
     *
     * @return void
     */
    public function testPreparePath()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
