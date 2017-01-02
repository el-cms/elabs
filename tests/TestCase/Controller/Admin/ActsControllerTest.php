<?php

namespace App\Test\TestCase\Controller\Admin;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\Admin\ActsController Test Case
 */
class ActsControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.acts',
        'app.albums',
        'app.files',
        'app.languages', // Needed for some layout vars
        'app.notes',
        'app.posts',
        'app.projects',
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

        $Acts = \Cake\ORM\TableRegistry::get('Acts');

        // Initial count
        $nb = $Acts->find()->count();
        $this->assertEquals(10, $nb);

        // POST method
        // -----------
        $this->post('/admin/acts/clean');

        // Take a look at the fixtures/list.md for counts
        $nb = $Acts->find()->count();
        $this->assertEquals(19, $nb);

        // No error
        $this->assertResponseEquals('');
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
