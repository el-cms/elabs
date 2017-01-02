<?php

namespace App\Model\Entity;

use CakeDC\Users\Model\Entity\User as BaseUserEntity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property string $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $website
 * @property string $bio
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $role
 * @property int $active
 * @property int $file_count
 * @property int $note_count
 * @property int $post_count
 * @property int $album_count
 * @property int $project_count
 * @property string $preferences
 *
 * Fields from CakeDC/Users
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $token
 * @property \Cake\I18n\Time $token_expire
 * @property string $api_token
 * @property \Cake\I18n\Time $activation_date
 * @property \Cake\I18n\Time $tos_date
 * @property bool is_superuser
 *
 * Virtual properties
 *
 * @property string $real_name
 *
 * Relations
 *
 * @property \App\Model\Entity\Album[] $albums
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\Project[] $projects
 * @property \App\Model\Entity\Report[] $reports
 */
class User extends BaseUserEntity
{
    /**
     * Returns the concatenation of the first and last names
     * @return string
     */
    protected function _getRealName()
    {
        return $this->first_name . ' ' . $this->last_name;
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
