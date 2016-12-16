<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AlbumsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AlbumsController Test Case
 */
class AlbumsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.albums',
        'app.users',
        'app.files',
        'app.languages',
        'app.comments',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/albums');
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
        $this->get('/albums/view/1727fe48-2825-4fd1-a5a1-357d5bd09531');
        $this->assertResponseOk();
        $this->markTestIncomplete('Not implemented yet.');
    }
}
