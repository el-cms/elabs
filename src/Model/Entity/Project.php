<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property string $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $mainurl
 * @property bool $sfw
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @propertu int $album_count
 * @propertu int $file_count
 * @propertu int $note_count
 * @propertu int $post_count
 * @property int $license_id
 * @property string $user_id
 * @property string $language_id
 *
 * @property \App\Model\Entity\License $license
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\Album[] $albums
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\Tag[] $tags
 * @property \App\Model\Entity\Act[] $acts
 */
class Project extends Entity
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
