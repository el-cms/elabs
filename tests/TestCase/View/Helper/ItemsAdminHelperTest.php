<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ItemsAdminHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ItemsAdminHelper Test Case
 */
class ItemsAdminHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\ItemsAdminHelper
     */
    public $ItemsAdminHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->ItemsAdminHelper = new ItemsAdminHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemsAdminHelper);

        parent::tearDown();
    }

    /**
     * Test statusLabel method
     *
     * @return void
     */
    public function testStatusLabel()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test sfwLabel method
     *
     * @return void
     */
    public function testSfwLabel()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
