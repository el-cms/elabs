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
        // Runs the test for all types of users in $this->usersCreds
        $this->assertAuthIsOkFor(['admin', 'author'], '/user/dashboard', ['get']);
    }
}
