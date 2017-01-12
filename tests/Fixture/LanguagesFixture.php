<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LanguagesFixture
 *
 */
class LanguagesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'string', 'length' => 3, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'iso639_1' => ['type' => 'string', 'length' => 2, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'has_site_translation' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'translation_folder' => ['type' => 'string', 'length' => 7, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'album_count' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
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
            'id' => 'aar',
            'iso639_1' => 'aa',
            'name' => 'Afaraf',
            'has_site_translation' => false,
            'translation_folder' => null,
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 5
        ],
        [
            'id' => 'ell',
            'iso639_1' => 'el',
            'name' => 'Ελληνικά',
            'has_site_translation' => false,
            'translation_folder' => null,
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
        ],
        [
            'id' => 'eng',
            'iso639_1' => 'en',
            'name' => 'English',
            'has_site_translation' => true,
            'translation_folder' => '',
            'album_count' => 1,
            'file_count' => 1,
            'note_count' => 0,
            'post_count' => 2,
            'project_count' => 1,
        ],
        [
            'id' => 'epo',
            'iso639_1' => 'eo',
            'name' => 'Esperanto',
            'has_site_translation' => false,
            'translation_folder' => null,
            'album_count' => 1,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 1,
        ],
        [
            'id' => 'fas',
            'iso639_1' => 'fa',
            'name' => '‫فارسی',
            'has_site_translation' => false,
            'translation_folder' => null,
            'album_count' => 1,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
        ],
        [
            'id' => 'fra',
            'iso639_1' => 'fr',
            'name' => 'Français',
            'has_site_translation' => true,
            'translation_folder' => 'fr_FR',
            'file_count' => 2,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 1,
            'album_count' => 1,
        ],
        [
            'id' => 'fry',
            'iso639_1' => 'fy',
            'name' => 'Frysk',
            'has_site_translation' => false,
            'translation_folder' => null,
            'album_count' => 1,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
        ],
        [
            'id' => 'ful',
            'iso639_1' => 'ff',
            'name' => 'Fulfulde',
            'has_site_translation' => false,
            'translation_folder' => null,
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
        ],
        [
            'id' => 'ger',
            'iso639_1' => 'de',
            'name' => 'Deutsch',
            'has_site_translation' => false,
            'translation_folder' => null,
            'album_count' => 0,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0,
        ],
    ];
}
