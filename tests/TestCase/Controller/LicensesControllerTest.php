<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LicensesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LicensesController Test Case
 */
class LicensesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.projects',
        'app.projects_files',
        'app.projects_notes',
        'app.projects_posts',
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
        $this->get('/licenses');

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
        $this->get('/licenses/view/1');

        $this->assertResponseOk();
        $this->markTestIncomplete('Not implemented yet.');
    }
}
