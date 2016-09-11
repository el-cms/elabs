<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ProjectsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ProjectsController Test Case
 */
class ProjectsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projects',
        'app.comments',
        'app.licenses',
        'app.languages',
        'app.users',
        'app.files',
        'app.notes',
        'app.posts'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/projects');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/projects/view/47a35a14-62ac-4f68-b617-01fea96ffa30');
        $this->assertResponseOk();
    }
}
