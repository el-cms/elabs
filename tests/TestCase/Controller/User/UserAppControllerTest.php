<?php

namespace App\Test\TestCase\Controller\User;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\User\UserAppController Test Case
 */
class UserAppControllerTest extends BaseTextCase
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
     * Test if access to unauthorized persons are rejected.
     *
     * @return void
     */
    public function testBeforeFilterBadCreds()
    {
        // Non logged user
        $this->session([]);
        $this->get('/user/dashboard/index');
        // User should be redirected to login page
        $this->assertRedirect('/users/login', 'Failed to reject non-logged user');
    }
}
