<?php

namespace App\Test\TestCase\Controller\User;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\User\TeamsController Test Case
 */
class TeamsControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // Needed for some layout vars
    ];

    /**
     * Users credentials to put in session in order to create a fake authentication
     *
     * @var array
     */
    public $userCreds = [
        'author' => ['Auth' => ['User' => ['id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32', 'email' => 'test@example.com', 'username' => 'real_test', 'realname' => 'The real tester', 'password' => '$2y$10$wpJrqUvcAlUbLUxLnP8P5.OU7TXtfjT4/K5RYGdjJVkh6BqNEh3XC', 'website' => null, 'bio' => 'Some things', 'created' => '2016-08-09 01:15:26', 'modified' => '2016-08-09 01:18:01', 'role' => 'author', 'see_nsfw' => false, 'status' => 1, 'file_count' => 0, 'note_count' => 0, 'post_count' => 1, 'project_count' => 0, 'preferences' => 'null']]],
    ];

    public function testIndex()
    {
        $this->markTestIncomplete('The controller is not even finished');
    }
}
