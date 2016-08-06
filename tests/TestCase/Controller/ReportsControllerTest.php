<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ReportsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ReportsController Test Case
 */
class ReportsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reports',
        'app.users',
        'app.files',
        'app.languages',
        'app.notes',
        'app.licenses',
        'app.posts',
        'app.tags',
        'app.posts_tags',
        'app.projects_tags',
        'app.projects',
        'app.projects_files',
        'app.projects_notes',
        'app.projects_posts',
        'app.teams',
        'app.teams_projects',
        'app.teams_users',
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
