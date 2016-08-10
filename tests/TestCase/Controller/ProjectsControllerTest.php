<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ProjectsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ProjectsController Test Case
 */
class ProjectsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projects',
        'app.licenses',
        'app.files',
        'app.languages',
        'app.notes',
        'app.users',
        'app.posts',
        'app.tags',
        'app.files_tags',
        'app.notes_tags',
        'app.posts_tags',
        'app.projects_tags',
        'app.projects_posts',
        'app.acts',
        'app.reports',
        'app.teams',
        'app.teams_projects',
        'app.teams_users',
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
        $this->get('/projects');

        $this->assertResponseOk();
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/projects/view/47a35a14-62ac-4f68-b617-01fea96ffa30');

        $this->assertResponseOk();
        $this->markTestIncomplete('Not implemented yet.');
    }
}
