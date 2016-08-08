<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\CowSaysHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\CowSaysHelper Test Case
 */
class CowSaysHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\CowSaysHelper
     */
    public $CowSaysHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->CowSaysHelper = new CowSaysHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CowSaysHelper);

        parent::tearDown();
    }

    /**
     * Test say method
     *
     * @return void
     */
    public function testSay()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test sayError method
     *
     * @return void
     */
    public function testSayError()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
