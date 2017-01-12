<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CommentsFixture
 *
 */
class CommentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'allow_contact' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'model' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fkid' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'message' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'comments_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'comments_ibfk_1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
        [ // Active admin (email and name may not match)
            'id' => 1,
            'name' => 'administrator',
            'email' => 'admin@example.com',
            'allow_contact' => true,
            'model' => 'Posts',
            'fkid' => '6e0c6123-2dbd-47d3-868b-9797cd9f3039',
            'created' => '2017-01-08 13:46:23',
            'message' => 'Here have some comment as a logged user',
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685'
        ],
        [ // Deleted author  (email and name may not match)
            'id' => 2,
            'name' => 'deleted',
            'email' => 'deleted@example.com',
            'allow_contact' => true,
            'model' => 'Posts',
            'fkid' => '6e0c6123-2dbd-47d3-868b-9797cd9f3039',
            'created' => '2017-01-08 14:46:23',
            'message' => 'Here have some comment as a deleted user',
            'user_id' => '38bffe56-5406-4f18-a9d2-f3b2a59608a5'
        ],
        [
            'id' => 3,
            'name' => 'Anonymousse',
            'email' => 'anon@example.com',
            'allow_contact' => false,
            'model' => 'Posts',
            'fkid' => '44bf30fc-e359-40ea-878a-2e7808c1de81',
            'created' => '2017-01-08 13:47:09',
            'message' => 'some random comment from an unknown visitor',
            'user_id' => null
        ],
    ];
}
