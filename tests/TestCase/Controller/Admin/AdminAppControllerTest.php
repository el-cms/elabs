<?php

namespace App\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\AdminAppController Test Case
 */
class AdminAppControllerTest extends IntegrationTestCase
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
     * Users credentials to put in session in order to create a fake authentication
     *
     * @var array
     */
    public $userCreds = [
        'admin' => ['Auth' => ['User' => ['id' => '70c8fff0-1338-48d2-b93b-942a26e4d685', 'email' => 'admin@example.com', 'username' => 'administrator', 'realname' => 'Administrator', 'website' => null, 'bio' => null, 'created' => null, 'modified' => null, 'role' => 'admin', 'status' => 1, 'file_count' => 3, 'note_count' => 0, 'post_count' => 1, 'project_count' => 3, 'preferences' => '{}']]],
        'author' => ['Auth' => ['User' => ['id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32', 'email' => 'test@example.com', 'username' => 'real_test', 'realname' => 'The real tester', 'website' => null, 'bio' => 'Some things', 'created' => '2016-08-09 01:15:26', 'modified' => '2016-08-09 01:18:01', 'role' => 'author', 'status' => 1, 'file_count' => 0, 'note_count' => 0, 'post_count' => 1, 'project_count' => 0, 'preferences' => 'null']]],
        'locked' => ['Auth' => ['User' => ['id' => 'e0b4c82b-3e99-4fe3-9b5f-dd71fac997e3', 'email' => 'locked@example.com', 'username' => 'locked_user', 'realname' => 'I\'m Locked', 'website' => null, 'bio' => 'Some text', 'created' => '2016-08-09 01:17:16', 'modified' => '2016-08-09 01:17:16', 'role' => 'author', 'status' => 0, 'file_count' => 0, 'note_count' => 0, 'post_count' => 0, 'project_count' => 0, 'preferences' => 'null']]],
        'closed' => ['Auth' => ['User' => ['id' => '38bffe56-5406-4f18-a9d2-f3b2a59608a5', 'email' => 'another@example.com', 'username' => 'deleted_user', 'realname' => 'Deleted one !', 'website' => null, 'bio' => 'I deleted my account', 'created' => '2016-08-09 01:16:27', 'modified' => '2016-08-09 01:17:55', 'role' => 'author', 'status' => 3, 'file_count' => 0, 'note_count' => 0, 'post_count' => 0, 'project_count' => 0, 'preferences' => 'null']]],
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
