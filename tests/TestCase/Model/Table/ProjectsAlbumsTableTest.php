<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectsAlbumsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectsAlbumsTable Test Case
 */
class ProjectsAlbumsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectsAlbumsTable
     */
    public $ProjectsAlbums;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projects_albums',
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
        'app.albums',
        'app.albums_files',
        'app.reports',
        'app.teams',
        'app.teams_projects',
        'app.teams_users',
        'app.projects_notes',
        'app.projects_files'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProjectsAlbums') ? [] : ['className' => 'App\Model\Table\ProjectsAlbumsTable'];
        $this->ProjectsAlbums = TableRegistry::get('ProjectsAlbums', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectsAlbums);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
