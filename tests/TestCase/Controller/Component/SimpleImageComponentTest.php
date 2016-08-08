<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\SimpleImageComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\SimpleImageComponent Test Case
 */
class SimpleImageComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\SimpleImageComponent
     */
    public $SimpleImageComponent;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->SimpleImageComponent = new SimpleImageComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SimpleImageComponent);

        parent::tearDown();
    }

    /**
     * Test load method
     *
     * @return void
     */
    public function testLoad()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test save method
     *
     * @return void
     */
    public function testSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test output method
     *
     * @return void
     */
    public function testOutput()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getWidth method
     *
     * @return void
     */
    public function testGetWidth()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getHeight method
     *
     * @return void
     */
    public function testGetHeight()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test resizeToHeight method
     *
     * @return void
     */
    public function testResizeToHeight()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test resizeToWidth method
     *
     * @return void
     */
    public function testResizeToWidth()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test scale method
     *
     * @return void
     */
    public function testScale()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test resize method
     *
     * @return void
     */
    public function testResize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test crop method
     *
     * @return void
     */
    public function testCrop()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test centerCrop method
     *
     * @return void
     */
    public function testCenterCrop()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test reset method
     *
     * @return void
     */
    public function testReset()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test waterMark method
     *
     * @return void
     */
    public function testWaterMark()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test centerCropFull method
     *
     * @return void
     */
    public function testCenterCropFull()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test cropFull method
     *
     * @return void
     */
    public function testCropFull()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getLog method
     *
     * @return void
     */
    public function testGetLog()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test resizeSmallestTo method
     *
     * @return void
     */
    public function testResizeSmallestTo()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test resizeBiggestTo method
     *
     * @return void
     */
    public function testResizeBiggestTo()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test rotate method
     *
     * @return void
     */
    public function testRotate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test rotateTo method
     *
     * @return void
     */
    public function testRotateTo()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
