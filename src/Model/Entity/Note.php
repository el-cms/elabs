<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Note Entity
 *
 * @property string $id
 * @property string $text
 * @property bool $sfw
 * @property int $status
 * @property string $user_id
 * @property string $language_id
 * @property int $licenses_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\License $license
 * @property \App\Model\Entity\Tag[] $tags
 * @property \App\Model\Entity\Project[] $projects
 */
class Note extends Entity
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
