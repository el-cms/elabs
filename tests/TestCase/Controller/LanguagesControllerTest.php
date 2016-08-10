<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LanguagesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LanguagesController Test Case
 */
class LanguagesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages',
        'app.files',
        'app.licenses',
        'app.posts',
        'app.users',
        'app.notes',
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
        $this->get('/languages');

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
        $this->get('/languages/view/eng');

        $this->assertResponseOk();
        $this->markTestIncomplete('Not implemented yet.');
    }
}
