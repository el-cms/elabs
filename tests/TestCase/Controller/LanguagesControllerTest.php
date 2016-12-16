<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LanguagesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LanguagesController Test Case
 */
class LanguagesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages',
        'app.posts',
        'app.files',
        'app.notes',
        'app.projects',
        'app.users',
        'app.licenses'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/languages');
//        $this->assertResponseEquals('');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/languages/view/eng');
        $this->assertResponseOk();
    }
}
