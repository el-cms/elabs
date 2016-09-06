<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property string $model
 * @property string $fkid
 * @property \Cake\I18n\Time $created
 * @property string $name
 * @property string $email
 * @property bool $allow_contact
 * @property string $message
 * @property string $user_id
 *
 * @property \App\Model\Entity\File $file
 * @property \App\Model\Entity\Note $note
 * @property \App\Model\Entity\Post $post
 * @property \App\Model\Entity\Project $project
 */
class Comment extends Entity
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
