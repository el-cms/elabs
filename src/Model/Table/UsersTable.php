<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Events
 * @property \Cake\ORM\Association\HasMany $Posts
 * @property \Cake\ORM\Association\HasMany $Projects
 */
class UsersTable extends Table {

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);

		$this->table('users');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->hasMany('Events', [
				'foreignKey' => 'user_id'
		]);
		$this->hasMany('Posts', [
				'foreignKey' => 'user_id'
		]);
		$this->hasMany('Projects', [
				'foreignKey' => 'user_id'
		]);
	}

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator) {
		$validator
						->add('id', 'valid', ['rule' => 'numeric'])
						->allowEmpty('id', 'create');

		$validator
						->add('email', 'valid', ['rule' => 'email'])
						->requirePresence('email', 'create')
						->notEmpty('email');

		$validator
						->requirePresence('username', 'create')
						->notEmpty('username', 'You should provide a user name');

		$validator
						->allowEmpty('realname', 'Your real name would be great');

		$validator
						->requirePresence('password', 'create')
						->notEmpty('password');

		$validator
						->allowEmpty('website');

		$validator
						->allowEmpty('bio');

		$validator
						->requirePresence('role', 'create')
						->notEmpty('role', 'A valid role is required.')
						->add('role', 'inlist', ['rule' => ['inList', ['admin', 'author', 'user']],
								'message' => 'Please enter a valid role']);

		$validator
						->add('see_nsfw', 'valid', ['rule' => 'boolean'])
						->allowEmpty('see_nsfw');

		$validator
						->add('status', 'valid', ['rule' => 'boolean'])
						->allowEmpty('status');

		return $validator;
	}

	/**
	 * Returns a rules checker object that will be used for validating
	 * application integrity.
	 *
	 * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
	 * @return \Cake\ORM\RulesChecker
	 */
	public function buildRules(RulesChecker $rules) {
		$rules->add($rules->isUnique(['email']));
		$rules->add($rules->isUnique(['username']));
		return $rules;
	}

}
