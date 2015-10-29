<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property bool $sfw
 * @property string $mainurl
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $license_id
 * @property \App\Model\Entity\License $license
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ProjectUser[] $project_users
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
        'id' => false,
    ];
}
