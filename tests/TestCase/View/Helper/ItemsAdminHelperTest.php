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
        // Removed, no icon
        $result = 'Removed';
        $this->assertEquals($result, $this->ItemsAdminHelper->statusLabel(3, false));

        $this->markTestIncomplete('Issue with AppHtmlHelper::iconT() not available in test.');

        // Waiting
        $result = '<i class="fa-exclamation fa-fw fa"></i>&nbsp;Waiting';
        $this->assertEquals($result, $this->ItemsAdminHelper->statusLabel(0));
        // Approved
        $result = '<i class="fa-exclamation fa-fw fa"></i>&nbsp;Published';
        $this->assertEquals($result, $this->ItemsAdminHelper->statusLabel(1));
        // Locked
        $result = '<i class="fa-exclamation fa-fw fa"></i>&nbsp;Locked';
        $this->assertEquals($result, $this->ItemsAdminHelper->statusLabel(2));
    }

    /**
     * Test sfwLabel method
     *
     * @return void
     */
    public function testSfwLabel()
    {
        // No, no icon
        $result = '<span class="label label-danger">No</span>';
        $this->assertEquals($result, $this->ItemsAdminHelper->sfwLabel(0, false));

        $this->markTestIncomplete('Issue with AppHtmlHelper::iconT() not available in test.');

        // Yes
        $result = '<span class="label label-success"><i class="fa-check fa-fw fa"></i>&nbsp;Yes</span>';
        $this->assertEquals($result, $this->ItemsAdminHelper->sfwLabel(1));
        // No
        $result = '<span class="label label-danger"><i class="fa-times fa-fw fa"></i>&nbsp;No</span>';
        $this->assertEquals($result, $this->ItemsAdminHelper->sfwLabel(0));
    }
}
