<?php

namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.albums',
        'app.users',
        'app.files',
        'app.languages',
        'app.notes',
        'app.licenses',
        'app.posts',
        'app.projects',
        'app.projects_posts',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/users');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('users/view/70c8fff0-1338-48d2-b93b-942a26e4d685');
        $this->assertResponseOk();
    }

    /**
     * Test register method
     *
     * @return void
     */
    public function testRegister()
    {
        $this->get('/users/register');
        $this->assertResponseOk();
    }

    /**
     * Test login method
     *
     * @return void
     */
    public function testLogin()
    {
        $this->get('/users/login');
        $this->assertResponseOk();
    }

    /**
     * Test logout method
     *
     * @return void
     */
    public function testLogout()
    {
        $this->get('/users/logout');
        $this->assertRedirect();
    }
}
