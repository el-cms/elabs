<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LicensesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LicensesController Test Case
 */
class LicensesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.licenses',
        'app.files',
        'app.languages',
        'app.notes',
        'app.users',
        'app.posts',
        'app.projects',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/licenses');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/licenses/view/1');
        $this->assertResponseOk();
    }
}
