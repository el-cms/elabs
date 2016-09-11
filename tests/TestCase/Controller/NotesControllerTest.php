<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NotesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\NotesController Test Case
 */
class NotesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notes',
        'app.comments',
        'app.users',
        'app.languages',
        'app.projects',
        'app.licenses',
        'app.projects',
        'app.projects_notes',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/notes');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/notes/view/c5fba703-fd07-4a1c-b7b0-345a76c36c33');
        $this->assertResponseOk();
    }
}
