<?php

namespace App\Test\TestCase\Controller\Admin;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\Admin\MaintenanceController Test Case
 */
class MaintenanceControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // Needed for some layout vars
    ];

    /**
     * Test clearCache method
     */
    public function testClearCache()
    {
        $this->markTestIncomplete();
    }
}
