<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ProjectsPostsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ProjectsPostsController Test Case
 */
class ProjectsPostsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projects_posts',
        'app.projects',
        'app.licenses',
        'app.files',
        'app.languages',
        'app.notes',
        'app.users',
        'app.posts',
        'app.tags',
        'app.posts_tags',
        'app.notes_tags',
        'app.files_tags',
        'app.projects_tags',
        'app.reports',
        'app.teams',
        'app.teams_users',
        'app.teams_projects',
        'app.projects_notes',
        'app.projects_files'
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
