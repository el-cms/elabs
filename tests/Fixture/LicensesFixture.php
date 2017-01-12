<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LicensesFixture
 *
 */
class LicensesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'link' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'icon' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'file_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'note_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'post_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'project_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
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
            'name' => 'CC BY',
            'link' => 'http://creativecommons.org/licenses/by/',
            'icon' => 'creative-commons',
            'file_count' => 3,
            'note_count' => 5,
            'post_count' => 2,
            'project_count' => 2,
        ],
        [
            'id' => 2,
            'name' => 'CC BY-NC',
            'link' => 'http://creativecommons.org/licenses/by-nc/',
            'icon' => 'creative-commons',
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
        ],
        [
            'id' => 3,
            'name' => 'CC BY-NC-SA 2.0',
            'link' => 'http://creativecommons.org/licenses/by-nc-sa/',
            'icon' => 'creative-commons',
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
        ],
        [
            'id' => 4,
            'name' => 'MIT',
            'link' => 'https://tldrlegal.com/license/mit-license',
            'icon' => 'copyright',
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 1,
        ],
    ];
}
