<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Files
 * @property \Cake\ORM\Association\HasMany $Posts
 * @property \Cake\ORM\Association\HasMany $Projects
 * @property \Cake\ORM\Association\HasMany $Reports
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('username');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Files', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Reports', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'uuid'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email', 'Your email is needed for login');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username', 'You should provide a user name')
            ->add('username', [
                'minLength' => [
                    'rule' => ['minLength', Configure::read('cms.defaultMinUserNameLenght')],
                    'message' => sprintf('User names must be %d characters min.', Configure::read('cms.defaultMinUserNameLenght')),
                ]
            ]);

        $validator
            ->allowEmpty('realname');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Without a password, you can\'t login.')
            ->add('password', [
                'minLength' => [
                    'rule' => ['minLength', Configure::read('cms.defaultMinPassLenght')],
                    'message' => sprintf('Passwords must be %d characters min.', Configure::read('cms.defaultMinPassLenght')),
                ]
            ])
            ->add('password', 'compare', [
                'rule' => function ($value, $context) {
                    return ($value === $context['data']['password_confirm']);
                },
                'message' => __d('users', 'Your password does not match your confirm password. Please try again'),
                'on' => ['create', 'update'],
                'allowEmpty' => false
            ]);

        $validator
            ->requirePresence('password_confirm', 'create')
            ->notEmpty('password_confirm');

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
            ->add('seeNSFW', 'valid', ['rule' => 'boolean'])
            ->requirePresence('seeNSFW', 'create')
            ->notEmpty('seeNSFW');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->add('post_count', 'valid', ['rule' => 'numeric'])
            ->requirePresence('post_count', 'create')
            ->notEmpty('post_count');

        $validator
            ->add('project_count', 'valid', ['rule' => 'numeric'])
            ->requirePresence('project_count', 'create')
            ->notEmpty('project_count');

        $validator
            ->add('file_count', 'valid', ['rule' => 'numeric'])
            ->requirePresence('file_count', 'create')
            ->notEmpty('file_count');

        $validator
            ->add('project_user_count', 'valid', ['rule' => 'numeric'])
            ->requirePresence('project_user_count', 'create')
            ->notEmpty('project_user_count');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }
}
