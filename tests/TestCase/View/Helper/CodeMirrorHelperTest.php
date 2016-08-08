<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\CodeMirrorHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\CodeMirrorHelper Test Case
 */
class CodeMirrorHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\CodeMirrorHelper
     */
    public $CodeMirrorHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->CodeMirrorHelper = new CodeMirrorHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CodeMirrorHelper);

        parent::tearDown();
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
     * Test scripts method
     *
     * @return void
     */
    public function testScripts()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
