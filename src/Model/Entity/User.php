<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $realname
 * @property string $password
 * @property string $website
 * @property string $bio
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $role
 * @property bool $see_nsfw
 * @property bool $status
 * @property \App\Model\Entity\Event[] $events
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\Project[] $projects
 */
class User extends Entity {

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

	protected function _setPassword($password) {
		return (new DefaultPasswordHasher)->hash($password);
	}

	public function comparePassword($password) {
		return (new DefaultPasswordHasher)->check($password, $this->password);
	}

}
