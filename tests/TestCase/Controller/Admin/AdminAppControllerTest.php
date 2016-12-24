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
        $this->get('/admin/dashboard/index');
        // User should be redirected to login page
        $this->assertRedirect('/users/login', 'Failed to reject non-logged user');

        // Test with an author
        $this->session($this->userCreds['author']);
        $this->get('/admin/dashboard/index');
        // Exception is thrown
        $this->assertResponseError();

        // Test with a locked user (even if this case is improbable)
        $this->session($this->userCreds['locked']);
        $this->get('/admin/dashboard/index');
        // Exception is thrown
        $this->assertResponseError();

        // Test with a closed user (even if this case is even more improbable)
        $this->session($this->userCreds['closed']);
        $this->get('/admin/dashboard/index');
        // Exception is thrown
        $this->assertResponseError();
    }
}
