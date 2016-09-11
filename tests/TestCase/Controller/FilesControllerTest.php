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
        'app.comments',
        'app.files',
        'app.languages',
        'app.users',
        'app.licenses',
        'app.tags',
        'app.files_tags',
        'app.projects',
        'app.projects_files'

    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/files');
        $this->assertResponseOk();
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
