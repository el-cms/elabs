<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilesTagsTable Test Case
 */
class FilesTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FilesTagsTable
     */
    public $FilesTagsTable;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.files_tags',
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
        'app.notes_tags',
        'app.posts_tags',
        'app.projects_tags',
        'app.acts',
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
        $config = TableRegistry::exists('FilesTags') ? [] : ['className' => 'App\Model\Table\FilesTagsTable'];
        $this->FilesTagsTable = TableRegistry::get('FilesTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FilesTagsTable);

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
