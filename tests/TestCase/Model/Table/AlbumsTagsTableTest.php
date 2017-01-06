<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AlbumsTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AlbumsTagsTable Test Case
 */
class AlbumsTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AlbumsTagsTable
     */
    public $AlbumsTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.albums_tags',
        'app.albums',
        'app.users',
        'app.social_accounts',
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
        'app.projects_albums',
        'app.acts',
        'app.albums_files',
        'app.reports'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AlbumsTags') ? [] : ['className' => 'App\Model\Table\AlbumsTagsTable'];
        $this->AlbumsTags = TableRegistry::get('AlbumsTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AlbumsTags);

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
