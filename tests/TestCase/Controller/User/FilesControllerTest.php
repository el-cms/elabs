<?php

namespace App\Test\TestCase\Controller\User;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\User\FilesController Test Case
 */
class FilesControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.files',
        'app.languages', // Needed for some layout vars
        'app.licenses',
        'app.users',
    ];

    /**
     * Users credentials to put in session in order to create a fake authentication
     *
     * @var array
     */
    public $userCreds = [
        'author' => ['Auth' => ['User' => ['id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32', 'email' => 'test@example.com', 'username' => 'real_test', 'realname' => 'The real tester', 'password' => '$2y$10$wpJrqUvcAlUbLUxLnP8P5.OU7TXtfjT4/K5RYGdjJVkh6BqNEh3XC', 'website' => null, 'bio' => 'Some things', 'created' => '2016-08-09 01:15:26', 'modified' => '2016-08-09 01:18:01', 'role' => 'author', 'status' => 1, 'file_count' => 0, 'note_count' => 0, 'post_count' => 1, 'project_count' => 0, 'preferences' => '{"showNSFW":"0","defaultSiteLanguage":"","defaultWritingLanguage":"eng","defaultWritingLicense":"1"}']]],
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
