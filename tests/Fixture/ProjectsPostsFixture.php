<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsPostsFixture
 *
 */
class ProjectsPostsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'project_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'posts_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_projects_has_posts_posts1_idx' => ['type' => 'index', 'columns' => ['posts_id'], 'length' => []],
            'fk_projects_has_posts_projects1_idx' => ['type' => 'index', 'columns' => ['project_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_projects_has_posts_posts1' => ['type' => 'foreign', 'columns' => ['posts_id'], 'references' => ['posts', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_projects_has_posts_projects1' => ['type' => 'foreign', 'columns' => ['project_id'], 'references' => ['projects', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'project_id' => '67baced7-58f7-49f7-9879-a47db0fd1786',
            'posts_id' => '85856eb9-a5f9-47fe-a2d6-add8d7ce0fc2'
        ],
    ];
}
