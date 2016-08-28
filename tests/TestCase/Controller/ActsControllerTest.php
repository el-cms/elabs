<?php

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ActsController Test Case
 */
class ActsControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.acts',
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
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        // Base page
        // ---------
        $this->get('/acts');
        $this->assertResponseOk();
        $nb = count($this->_controller->viewVars['acts']);
        $this->assertEquals(10, $nb);
        // Filters
        // -------
        $this->get('/acts/index/hideUpdates');
        $nb = count($this->_controller->viewVars['acts']);
        $this->assertEquals(8, $nb);
        $this->assertResponseOk();
    }
}
