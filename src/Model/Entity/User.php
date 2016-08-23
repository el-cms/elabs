<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property string $id
 * @property string $email
 * @property string $username
 * @property string $realname
 * @property string $password
 * @property string $website
 * @property string $bio
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $role
 * @property int $status
 * @property int $file_count
 * @property int $note_count
 * @property int $post_count
 * @property int $project_count
 * @property int $project_user_count
 * @property string $preferences
 *
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\Project[] $projects
 * @property \App\Model\Entity\Report[] $reports
 * @property \App\Model\Entity\Team[] $teams
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * Hashes a password
     *
     * @param string $password Password to hash
     *
     * @return string
     */
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
    /**
     * Compare two hashed passwords
     *
     * @param string $password Password to check
     * @return int
     */
    public function comparePassword($password)
    {
        return (new DefaultPasswordHasher)->check($password, $this->password);
    }
}
