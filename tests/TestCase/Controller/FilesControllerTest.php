<?php
namespace App\Test\TestCase\Controller;

use App\Controller\FilesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\FilesController Test Case
 */
class FilesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.files',
        'app.languages',
        'app.notes',
        'app.users',
        'app.posts',
        'app.licenses',
        'app.projects',
        'app.projects_files',
        'app.projects_notes',
        'app.projects_posts',
        'app.tags',
        'app.files_tags',
        'app.notes_tags',
        'app.posts_tags',
        'app.projects_tags',
        'app.teams',
        'app.teams_projects',
        'app.teams_users',
        'app.acts',
        'app.reports'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/acts');

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
        $this->get('/files/view/4aa59eb5-35c6-42c1-91e2-f8c6a6cb8539');

        $this->assertResponseOk();
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test download method
     *
     * @return void
     */
    public function testDownload()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
