<?php

namespace App\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\DashboardController Test Case
 */
class DashboardControllerTest extends IntegrationTestCase
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
    ];

    /**
     * Test index setup
     *
     * @return void
     */
    public function testIndex()
    {
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/dashboard');
        // Exception
        $this->assertResponseOk();

        $this->markTestIncomplete();
    }
}
