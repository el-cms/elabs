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
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 5
        ],
        [
            'id' => 'abk',
            'iso639_1' => 'ab',
            'name' => 'Аҧсуа',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'afr',
            'iso639_1' => 'af',
            'name' => 'Afrikaans',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'aka',
            'iso639_1' => 'ak',
            'name' => 'Akan',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'amh',
            'iso639_1' => 'am',
            'name' => 'አማርኛ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ara',
            'iso639_1' => 'ar',
            'name' => '‫العربية',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'arg',
            'iso639_1' => 'an',
            'name' => 'Aragonés',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'asm',
            'iso639_1' => 'as',
            'name' => 'অসমীয়া',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ava',
            'iso639_1' => 'av',
            'name' => 'авар мацӀ ; магӀарул мацӀ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ave',
            'iso639_1' => 'ae',
            'name' => 'Avesta',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'aym',
            'iso639_1' => 'ay',
            'name' => 'Aymar aru',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'aze',
            'iso639_1' => 'az',
            'name' => 'Azərbaycan dili',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'bak',
            'iso639_1' => 'ba',
            'name' => 'башҡорт теле',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'bam',
            'iso639_1' => 'bm',
            'name' => 'Bamanankan',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'bel',
            'iso639_1' => 'be',
            'name' => 'Беларуская',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ben',
            'iso639_1' => 'bn',
            'name' => 'বাংলা',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'bih',
            'iso639_1' => 'bh',
            'name' => 'भोजपुरी',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'bis',
            'iso639_1' => 'bi',
            'name' => 'Bislama',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'bod',
            'iso639_1' => 'bo',
            'name' => 'བོད་ཡིག',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'bos',
            'iso639_1' => 'bs',
            'name' => 'Bosanski jezik',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'bre',
            'iso639_1' => 'br',
            'name' => 'Brezhoneg',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'bul',
            'iso639_1' => 'bg',
            'name' => 'български език',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'cat',
            'iso639_1' => 'ca',
            'name' => 'Català',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'cha',
            'iso639_1' => 'ch',
            'name' => 'Chamoru',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'che',
            'iso639_1' => 'ce',
            'name' => 'нохчийн мотт',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'chu',
            'iso639_1' => 'cu',
            'name' => 'Словѣньскъ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'chv',
            'iso639_1' => 'cv',
            'name' => 'чӑваш чӗлхи',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'cor',
            'iso639_1' => 'kw',
            'name' => 'Kernewek',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'cos',
            'iso639_1' => 'co',
            'name' => 'Corsu',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'cre',
            'iso639_1' => 'cr',
            'name' => 'ᓀᐦᐃᔭᐍᐏᐣ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'cym',
            'iso639_1' => 'cy',
            'name' => 'Cymraeg',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'cze',
            'iso639_1' => 'cs',
            'name' => 'Česky ; čeština',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'dan',
            'iso639_1' => 'da',
            'name' => 'Dansk',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'div',
            'iso639_1' => 'dv',
            'name' => '‫ދިވެހި',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'dzo',
            'iso639_1' => 'dz',
            'name' => 'རྫོང་ཁ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ell',
            'iso639_1' => 'el',
            'name' => 'Ελληνικά',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'eng',
            'iso639_1' => 'en',
            'name' => 'English',
            'has_site_translation' => true,
            'translation_folder' => '',
            'file_count' => 1,
            'note_count' => 0,
            'post_count' => 2,
            'project_count' => 1
        ],
        [
            'id' => 'epo',
            'iso639_1' => 'eo',
            'name' => 'Esperanto',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 1
        ],
        [
            'id' => 'est',
            'iso639_1' => 'et',
            'name' => 'Eesti keel',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'eus',
            'iso639_1' => 'eu',
            'name' => 'Euskara',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ewe',
            'iso639_1' => 'ee',
            'name' => 'Ɛʋɛgbɛ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'fao',
            'iso639_1' => 'fo',
            'name' => 'Føroyskt',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'fas',
            'iso639_1' => 'fa',
            'name' => '‫فارسی',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'fij',
            'iso639_1' => 'fj',
            'name' => 'Vosa Vakaviti',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'fin',
            'iso639_1' => 'fi',
            'name' => 'Suomen kieli',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
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
            'project_count' => 1
        ],
        [
            'id' => 'fry',
            'iso639_1' => 'fy',
            'name' => 'Frysk',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ful',
            'iso639_1' => 'ff',
            'name' => 'Fulfulde',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ger',
            'iso639_1' => 'de',
            'name' => 'Deutsch',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'gla',
            'iso639_1' => 'gd',
            'name' => 'Gàidhlig',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'gle',
            'iso639_1' => 'ga',
            'name' => 'Gaeilge',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'glg',
            'iso639_1' => 'gl',
            'name' => 'Galego',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'glv',
            'iso639_1' => 'gv',
            'name' => 'Ghaelg',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'grn',
            'iso639_1' => 'gn',
            'name' => 'Avañe\'ẽ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'guj',
            'iso639_1' => 'gu',
            'name' => 'ગુજરાતી',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'hat',
            'iso639_1' => 'ht',
            'name' => 'Kreyòl ayisyen',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'hau',
            'iso639_1' => 'ha',
            'name' => '‫هَوُسَ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'heb',
            'iso639_1' => 'he',
            'name' => '‫עברית',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'her',
            'iso639_1' => 'hz',
            'name' => 'Otjiherero',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'hin',
            'iso639_1' => 'hi',
            'name' => 'हिन्दी ; हिंदी',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'hmo',
            'iso639_1' => 'ho',
            'name' => 'Hiri Motu',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'hrv',
            'iso639_1' => 'hr',
            'name' => 'Hrvatski',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'hun',
            'iso639_1' => 'hu',
            'name' => 'magyar',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'hye',
            'iso639_1' => 'hy',
            'name' => 'Հայերեն',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ibo',
            'iso639_1' => 'ig',
            'name' => 'Igbo',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ido',
            'iso639_1' => 'io',
            'name' => 'Ido',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'iii',
            'iso639_1' => 'ii',
            'name' => 'ꆇꉙ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'iku',
            'iso639_1' => 'iu',
            'name' => 'ᐃᓄᒃᑎᑐᑦ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ile',
            'iso639_1' => 'ie',
            'name' => 'Interlingue',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ina',
            'iso639_1' => 'ia',
            'name' => 'Interlingua',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ind',
            'iso639_1' => 'id',
            'name' => 'Bahasa Indonesia',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ipk',
            'iso639_1' => 'ik',
            'name' => 'Iñupiaq ; Iñupiatun',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'isl',
            'iso639_1' => 'is',
            'name' => 'Íslenska',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ita',
            'iso639_1' => 'it',
            'name' => 'Italiano',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'jav',
            'iso639_1' => 'jv',
            'name' => 'Basa Jawa',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'jpn',
            'iso639_1' => 'ja',
            'name' => '日本語 (にほんご)',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kal',
            'iso639_1' => 'kl',
            'name' => 'Kalaallisut ; kalaallit oqaasii',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kan',
            'iso639_1' => 'kn',
            'name' => 'ಕನ್ನಡ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kas',
            'iso639_1' => 'ks',
            'name' => 'कश्मीरी ; كشميري',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kat',
            'iso639_1' => 'ka',
            'name' => 'ქართული',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kau',
            'iso639_1' => 'kr',
            'name' => 'Kanuri',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kaz',
            'iso639_1' => 'kk',
            'name' => 'Қазақ тілі',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'khm',
            'iso639_1' => 'km',
            'name' => 'ភាសាខ្មែរ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kik',
            'iso639_1' => 'ki',
            'name' => 'Gĩkũyũ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kin',
            'iso639_1' => 'rw',
            'name' => 'Kinyarwanda',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kir',
            'iso639_1' => 'ky',
            'name' => 'кыргыз тили',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kom',
            'iso639_1' => 'kv',
            'name' => 'коми кыв',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kon',
            'iso639_1' => 'kg',
            'name' => 'KiKongo',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kor',
            'iso639_1' => 'ko',
            'name' => '한국어 (韓國語) ; 조선말 (朝鮮語)',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kua',
            'iso639_1' => 'kj',
            'name' => 'Kuanyama',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'kur',
            'iso639_1' => 'ku',
            'name' => 'Kurdî ; كوردی',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'lao',
            'iso639_1' => 'lo',
            'name' => 'ພາສາລາວ',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'lat',
            'iso639_1' => 'la',
            'name' => 'Latine ; lingua latina',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'lav',
            'iso639_1' => 'lv',
            'name' => 'Latviešu valoda',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'lim',
            'iso639_1' => 'li',
            'name' => 'Limburgs',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'lin',
            'iso639_1' => 'ln',
            'name' => 'Lingála',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'lit',
            'iso639_1' => 'lt',
            'name' => 'Lietuvių kalba',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'ltz',
            'iso639_1' => 'lb',
            'name' => 'Lëtzebuergesch',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'lub',
            'iso639_1' => 'lu',
            'name' => 'kiluba',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
        [
            'id' => 'lug',
            'iso639_1' => 'lg',
            'name' => 'Luganda',
            'has_site_translation' => false,
            'translation_folder' => null,
            'file_count' => 0,
            'note_count' => 0,
            'post_count' => 0,
            'project_count' => 0
        ],
    ];
}
