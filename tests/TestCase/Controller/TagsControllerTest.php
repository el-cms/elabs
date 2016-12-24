<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TagsController Test Case
 */
class TagsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tags',
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
        'app.projects_tags',
        'app.teams',
        'app.teams_projects',
        'app.teams_users',
        'app.acts',
        'app.posts_tags',
        'app.reports',
        'app.notes_tags',
        'app.files_tags'
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
}
