<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostsTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostsTagsTable Test Case
 */
class PostsTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PostsTagsTable
     */
    public $PostsTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.posts_tags',
        'app.posts',
        'app.users',
        'app.files',
        'app.languages',
        'app.notes',
        'app.licenses',
        'app.projects',
        'app.tags',
        'app.notes_tags',
        'app.projects_notes',
        'app.files_tags',
        'app.projects_files',
        'app.reports',
        'app.teams',
        'app.teams_users',
        'app.projects_posts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PostsTags') ? [] : ['className' => 'App\Model\Table\PostsTagsTable'];
        $this->PostsTags = TableRegistry::get('PostsTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostsTags);

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
