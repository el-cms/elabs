<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\AppHtmlHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\AppHtmlHelper Test Case
 */
class AppHtmlHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\AppHtmlHelper
     */
    public $AppHtmlHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->AppHtmlHelper = new AppHtmlHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AppHtmlHelper);

        parent::tearDown();
    }

    /**
     * Test icon method
     *
     * @return void
     */
    public function testIcon()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test iconT method
     *
     * @return void
     */
    public function testIconT()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test arrayToString method
     *
     * @return void
     */
    public function testArrayToString()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test reportLink method
     *
     * @return void
     */
    public function testReportLink()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test displayMD method
     *
     * @return void
     */
    public function testDisplayMD()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test langLabel method
     *
     * @return void
     */
    public function testLangLabel()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test checkIcon method
     *
     * @return void
     */
    public function testCheckIcon()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
