<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\LicenseHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\LicenseHelper Test Case
 */
class LicenseHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\LicenseHelper
     */
    public $LicenseHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->LicenseHelper = new LicenseHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LicenseHelper);

        parent::tearDown();
    }

    /**
     * Test d method
     *
     * @return void
     */
    public function testD()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
