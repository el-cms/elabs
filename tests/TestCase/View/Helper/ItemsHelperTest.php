<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ItemsHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ItemsHelper Test Case
 */
class ItemsHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\ItemsHelper
     */
    public $ItemsHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->ItemsHelper = new ItemsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemsHelper);

        parent::tearDown();
    }

    /**
     * Test fileConfig method
     *
     * @return void
     */
    public function testFileConfig()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
