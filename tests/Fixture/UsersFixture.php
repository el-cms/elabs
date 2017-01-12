<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'username' => ['type' => 'string', 'length' => 32, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'last_name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'website' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'bio' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'preferences' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'active' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'role' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'author', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'album_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'file_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'note_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'post_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'project_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'token' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'token_expires' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'api_token' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'activation_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'tos_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'is_superuser' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        // Deleted author
        [
            'id' => '38bffe56-5406-4f18-a9d2-f3b2a59608a5',
            'email' => 'another@example.com',
            'username' => 'deleted_user',
            'first_name' => 'Deleted',
            'last_name' => 'User',
            'password' => '$2y$10$1RxiKzYX34NBj6/i70484.JWXozpSXRyBeN9i0jXAdKBLE.dex9/C',
            'website' => null,
            'bio' => 'I deleted my account',
            'preferences' => '{"showNSFW":"0","defaultSiteLanguage":"","defaultWritingLanguage":"eng","defaultWritingLicense":"1"}',
            'created' => '2016-08-09 01:16:27',
            'modified' => '2016-08-09 01:17:55',
            'active' => 3,
            'role' => 'author',
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
            'token' => '',
            'token_expires' => null,
            'api_token' => '',
            'activation_date' => null,
            'tos_date' => null,
            'is_superuser' => 0,
        ],
        // Active admin
        [
            'id' => '70c8fff0-1338-48d2-b93b-942a26e4d685',
            'email' => 'admin@example.com',
            'username' => 'administrator',
            'first_name' => 'Admin',
            'last_name' => 'The',
            'password' => '$2y$10$pJFTSCWc95bPWyrPwlnxSuowIJhe59wc/iKb35bCG3mCnBnBVup5u',
            'website' => null,
            'bio' => null,
            'preferences' => '{"showNSFW":"1","defaultSiteLanguage":"fr_FR","defaultWritingLanguage":"fra","defaultWritingLicense":"3"}',
            'created' => '2016-08-09 01:16:27',
            'modified' => '2016-08-09 01:16:27',
            'active' => 1,
            'role' => 'admin',
            'album_count' => 0,
            'file_count' => 3,
            'note_count' => 0,
            'post_count' => 1,
            'project_count' => 3,
            'token' => '',
            'token_expires' => null,
            'api_token' => '',
            'activation_date' => null,
            'tos_date' => null,
            'is_superuser' => 1,
        ],
        // Active author
        [
            'id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32',
            'email' => 'test@example.com',
            'username' => 'real_test',
            'first_name' => 'Test',
            'last_name' => 'Test',
            'password' => '$2y$10$wpJrqUvcAlUbLUxLnP8P5.OU7TXtfjT4/K5RYGdjJVkh6BqNEh3XC',
            'website' => null,
            'bio' => 'Some things',
            'preferences' => '{"showNSFW":"0","defaultSiteLanguage":"","defaultWritingLanguage":"hin","defaultWritingLicense":"2"}',
            'created' => '2016-08-09 01:15:26',
            'modified' => '2016-08-09 01:18:01',
            'active' => 1,
            'role' => 'author',
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 1,
            'project_count' => 0,
            'token' => '',
            'token_expires' => null,
            'api_token' => '',
            'activation_date' => null,
            'tos_date' => null,
            'is_superuser' => 0,
        ],
        // Inactive author
        [
            'id' => 'e0b4c82b-3e99-4fe3-9b5f-dd71fac997e3',
            'email' => 'locked@example.com',
            'username' => 'not_activated',
            'first_name' => 'Not',
            'last_name' => 'Activated',
            'password' => '$2y$10$GxcIuTXH6.Ty2mDk7juaPOABxdTA7XW1MHfxnrr7AL2q/3VGiZRGC',
            'website' => null,
            'bio' => 'Some text',
            'preferences' => '{"showNSFW":"1","defaultSiteLanguage":"","defaultWritingLanguage":"eng","defaultWritingLicense":"1"}',
            'created' => '2016-08-09 01:17:16',
            'modified' => '2016-08-09 01:17:16',
            'active' => 0,
            'role' => 'author',
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
            'token' => '',
            'token_expires' => null,
            'api_token' => '',
            'activation_date' => null,
            'tos_date' => null,
            'is_superuser' => 0,
        ],
        // Locked author
        [
            'id' => 'fbb4c82b-3e99-4fe3-9b5f-dd71fac997aa',
            'email' => 'locked@example.com',
            'username' => 'Locked',
            'first_name' => 'Not',
            'last_name' => 'Activated',
            'password' => '$2y$10$GxcIuTXH6.Ty2mDk7juaPOABxdTA7XW1MHfxnrr7AL2q/3VGiZRGC',
            'website' => null,
            'bio' => 'Some text',
            'preferences' => '{"showNSFW":"1","defaultSiteLanguage":"","defaultWritingLanguage":"eng","defaultWritingLicense":"1"}',
            'created' => '2016-08-09 01:17:16',
            'modified' => '2016-08-09 01:17:16',
            'active' => 2,
            'role' => 'author',
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
            'token' => '',
            'token_expires' => null,
            'api_token' => '',
            'activation_date' => null,
            'tos_date' => null,
            'is_superuser' => 0,
        ],
    ];
}
