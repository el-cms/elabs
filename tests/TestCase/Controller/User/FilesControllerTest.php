<?php

namespace App\Test\TestCase\Controller\User;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\User\FilesController Test Case
 */
class FilesControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.acts',
        'app.albums',
        'app.albums_files',
        'app.files',
        'app.files_tags',
        'app.languages', // Needed for some layout vars
        'app.licenses',
        'app.projects',
        'app.projects_files',
        'app.tags',
        'app.users',
    ];

    /**
     * Test Index action
     *
     * @return void
     */
    public function testIndex() //nsfw //status
    {
        // Set session data
        $this->session($this->userCreds['author']);

        // No filters
        // ----------
        $this->get('/user/files');
        $nb = count($this->_controller->viewVars['files']);
        $this->assertEquals(5, $nb);
        $this->assertResponseOk();

        // Sfw filter
        // ----------
        // Safe only
        $this->get('/user/files/index/safe/all');
        $nb = count($this->_controller->viewVars['files']);
        $this->assertEquals(2, $nb);
        $this->assertResponseOk();

        // Unsafe only
        $this->get('/user/files/index/unsafe/all');
        $nb = count($this->_controller->viewVars['files']);
        $this->assertEquals(3, $nb);
        $this->assertResponseOk();

        // Status filter
        // -------------
        // Locked
        $this->get('/user/files/index/all/locked');
        $nb = count($this->_controller->viewVars['files']);
        $this->assertEquals(1, $nb);
        $this->assertResponseOk();
    }

    /**
     * Test add action
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete();
    }

    /**
     * Test edit action
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete();
    }

    /**
     * Test delete action
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete();
    }
}
