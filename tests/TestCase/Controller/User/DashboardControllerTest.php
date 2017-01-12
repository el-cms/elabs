<?php

namespace App\Test\TestCase\Controller\User;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\User\DashboardController Test Case
 */
class DashboardControllerTest extends BaseTextCase
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
     * Test index setup
     *
     * @return void
     */
    public function testIndex()
    {
        // Set session data
        $this->session($this->userCreds['author']);
        $this->get('/user/dashboard');
        // Exception
        $this->assertResponseOk();

        $this->markTestIncomplete('Dashboard is not complete');
    }
}
