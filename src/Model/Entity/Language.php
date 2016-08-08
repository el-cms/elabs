<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Language Entity
 *
 * @property string $id
 * @property string $iso639_1
 * @property string $name
 * @property bool $has_site_translation
 * @property string $translation_folder
 * @property int $file_count
 * @property int $note_count
 * @property int $post_count
 * @property int $project_count
 *
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\Project[] $projects
 */
class Language extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
