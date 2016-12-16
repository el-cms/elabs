<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AlbumsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AlbumsController Test Case
 */
class AlbumsControllerTest extends IntegrationTestCase
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
        'app.tags',
        'app.files_tags',
        'app.notes_tags',
        'app.posts_tags',
        'app.projects',
        'app.projects_files',
        'app.projects_notes',
        'app.projects_posts',
        'app.projects_tags',
        'app.teams',
        'app.teams_projects',
        'app.teams_users',
        'app.acts',
        'app.projects_albums',
        'app.albums_files',
        'app.reports'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/albums');
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
        $this->get('/albums/view/1727fe48-2825-4fd1-a5a1-357d5bd09531');
        $this->assertResponseOk();
        $this->markTestIncomplete('Not implemented yet.');
    }

}
