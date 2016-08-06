<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\PostsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\PostsController Test Case
 */
class PostsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.posts',
        'app.users',
        'app.files',
        'app.languages',
        'app.notes',
        'app.licenses',
        'app.projects',
        'app.projects_notes',
        'app.projects_files',
        'app.projects_posts',
        'app.tags',
        'app.notes_tags',
        'app.files_tags',
        'app.posts_tags',
        'app.reports',
        'app.teams',
        'app.teams_users'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
