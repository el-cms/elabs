<?php

namespace App\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\ActsController Test Case
 */
class ActsControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.acts',
        'app.files',
        'app.languages', // Needed for some layout vars
        'app.notes',
        'app.posts',
        'app.projects',
    ];

    /**
     * Users credentials to put in session in order to create a fake authentication
     *
     * @var array
     */
    public $userCreds = [
        'admin' => ['Auth' => ['User' => ['id' => '70c8fff0-1338-48d2-b93b-942a26e4d685', 'email' => 'admin@example.com', 'username' => 'administrator', 'realname' => 'Administrator', 'website' => null, 'bio' => null, 'created' => null, 'modified' => null, 'role' => 'admin', 'see_nsfw' => true, 'status' => 1, 'file_count' => 3, 'note_count' => 0, 'post_count' => 1, 'project_count' => 3, 'preferences' => '{}']]],
    ];

    /**
     * Test clean method with admin user
     *
     * @return void
     */
    public function testClean()
    {
        // Set session data
        $this->session($this->userCreds['admin']);

        // POST method
        // -----------
        $this->post('/admin/acts/clean');

        // Take a look at the fixtures/list.md for counts
        $Acts = \Cake\ORM\TableRegistry::get('Acts');
        $nb = $Acts->find()->count();
        $this->assertEquals(16, $nb);

        // No error
        $this->assertResponseEmpty();

        // User should be redirected to '/' as no referer is available in tests
        $this->assertRedirect('/');

        // GET method
        // -----------
        $this->get('/admin/acts/clean');
        // Exception
        $this->assertResponseError();
    }
}
