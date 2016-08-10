<?php

namespace App\Test\TestCase\Controller\User;

use App\Controller\User\DashboardController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\User\DashboardController Test Case
 */
class DashboardControllerTest extends IntegrationTestCase
{
    public $userCreds = [
        'admin' => ['Auth' => ['User' => ['id' => '70c8fff0-1338-48d2-b93b-942a26e4d685', 'email' => 'admin@example.com', 'username' => 'administrator', 'realname' => 'Administrator', 'website' => null, 'bio' => null, 'created' => null, 'modified' => null, 'role' => 'admin', 'see_nsfw' => true, 'status' => 1, 'file_count' => 3, 'note_count' => 0, 'post_count' => 1, 'project_count' => 3, 'preferences' => '{}']]],
        'author' => ['Auth' => ['User' => ['id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32', 'email' => 'test@example.com', 'username' => 'real_test', 'realname' => 'The real tester', 'password' => '$2y$10$wpJrqUvcAlUbLUxLnP8P5.OU7TXtfjT4/K5RYGdjJVkh6BqNEh3XC', 'website' => null, 'bio' => 'Some things', 'created' => '2016-08-09 01:15:26', 'modified' => '2016-08-09 01:18:01', 'role' => 'author', 'see_nsfw' => false, 'status' => 1, 'file_count' => 0, 'note_count' => 0, 'post_count' => 1, 'project_count' => 0, 'preferences' => 'null']]],
        'locked' => ['Auth' => ['User' => ['id' => 'e0b4c82b-3e99-4fe3-9b5f-dd71fac997e3', 'email' => 'locked@example.com', 'username' => 'locked_user', 'realname' => 'I\'m Locked', 'password' => '$2y$10$GxcIuTXH6.Ty2mDk7juaPOABxdTA7XW1MHfxnrr7AL2q/3VGiZRGC', 'website' => null, 'bio' => 'Some text', 'created' => '2016-08-09 01:17:16', 'modified' => '2016-08-09 01:17:16', 'role' => 'author', 'see_nsfw' => false, 'status' => 0, 'file_count' => 0, 'note_count' => 0, 'post_count' => 0, 'project_count' => 0, 'preferences' => 'null']]],
        'closed' => ['Auth' => ['User' => ['id' => '38bffe56-5406-4f18-a9d2-f3b2a59608a5', 'email' => 'another@example.com', 'username' => 'deleted_user', 'realname' => 'Deleted one !', 'password' => '$2y$10$1RxiKzYX34NBj6/i70484.JWXozpSXRyBeN9i0jXAdKBLE.dex9/C', 'website' => null, 'bio' => 'I deleted my account', 'created' => '2016-08-09 01:16:27', 'modified' => '2016-08-09 01:17:55', 'role' => 'author', 'see_nsfw' => false, 'status' => 3, 'file_count' => 0, 'note_count' => 0, 'post_count' => 0, 'project_count' => 0, 'preferences' => 'null']]],
    ];

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
