<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\FormHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\FormHelper Test Case
 */
class FormHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\FormHelper
     */
    public $FormHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->FormHelper = new FormHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormHelper);

        parent::tearDown();
    }

    /**
     * Test dateTime method
     *
     * @return void
     */
    public function testDateTime()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test dateTimeWidget method
     *
     * @return void
     */
    public function testDateTimeWidget()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
