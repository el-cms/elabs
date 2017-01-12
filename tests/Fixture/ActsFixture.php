<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActsFixture
 *
 */
class ActsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'fkid' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'model' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'type' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
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
        [
            'id' => 1,
            'model' => 'Posts',
            'fkid' => '6e0c6123-2dbd-47d3-868b-9797cd9f3039',
            'type' => 'add',
            'created' => '2016-08-09 00:42:25'
        ],
        [
            'id' => 2,
            'model' => 'Projects',
            'fkid' => 'e5e2988e-2f1c-4902-ba1a-e0f577413f23',
            'type' => 'add',
            'created' => '2016-08-09 00:44:45'
        ],
        [
            'id' => 3,
            'model' => 'Projects',
            'fkid' => '9a9b6e60-6572-4b47-a161-e37ae81e16a8',
            'type' => 'add',
            'created' => '2016-08-09 00:45:25'
        ],
        [
            'id' => 4,
            'model' => 'Projects',
            'fkid' => '47a35a14-62ac-4f68-b617-01fea96ffa30',
            'type' => 'add',
            'created' => '2016-08-09 00:46:17'
        ],
        [
            'id' => 5,
            'model' => 'Files',
            'fkid' => 'cafc0f93-d435-468e-afc7-30a38ee811eb',
            'type' => 'add',
            'created' => '2016-08-09 00:46:45'
        ],
        [
            'id' => 6,
            'model' => 'Files',
            'fkid' => '63c22253-9f07-41de-abcf-c9e0a9eaf7e9',
            'type' => 'add',
            'created' => '2016-08-09 00:47:16'
        ],
        [
            'id' => 7,
            'model' => 'Files',
            'fkid' => '4aa59eb5-35c6-42c1-91e2-f8c6a6cb8539',
            'type' => 'add',
            'created' => '2016-08-09 00:48:02'
        ],
        [
            'id' => 8,
            'model' => 'Posts',
            'fkid' => 'd5f4a0fa-2956-465e-ab99-2c975df276b9',
            'type' => 'add',
            'created' => '2016-08-09 01:21:23'
        ],
        [
            'id' => 9,
            'model' => 'Posts',
            'fkid' => 'd5f4a0fa-2956-465e-ab99-2c975df276b9',
            'type' => 'edit',
            'created' => '2016-08-08 02:21:23'
        ],
        [
            'id' => 10,
            'model' => 'Posts',
            'fkid' => 'd5f4a0fa-2956-465e-ab99-2c975df276b9',
            'type' => 'edit',
            'created' => '2016-08-08 03:21:23'
        ],
    ];
}
