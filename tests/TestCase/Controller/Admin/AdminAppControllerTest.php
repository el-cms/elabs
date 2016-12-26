<?php

namespace App\Test\TestCase\Controller\Admin;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\Admin\AdminAppController Test Case
 */
class AdminAppControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // Needed for some layout vars
        'app.users', // Needed for some layout vars
    ];

    /**
     * Test if access to unauthorized persons are rejected.
     *
     * @return void
     */
    public function testBeforeFilterBadCreds()
    {
        // Runs the test for all types of users in $this->usersCreds
        $this->assertAuthIsOkFor(['admin'], '/admin/dashboard', ['get']);
    }
}
