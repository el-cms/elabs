<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\UsersAdminHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\UsersAdminHelper Test Case
 */
class UsersAdminHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\UsersAdminHelper
     */
    public $UsersAdminHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->UsersAdminHelper = new UsersAdminHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersAdminHelper);

        parent::tearDown();
    }

    /**
     * Test roleLabel method
     *
     * @return void
     */
    public function testRoleLabel()
    {
        $this->markTestIncomplete('Not implemented yet.');
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
}
