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
        'app.users',
        'app.languages',
        'app.projects',
        'app.licenses'
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
        $this->markTestIncomplete('Not implemented yet.');
    }
}
