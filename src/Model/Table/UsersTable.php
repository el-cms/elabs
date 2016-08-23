<?php

namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Files
 * @property \Cake\ORM\Association\HasMany $Notes
 * @property \Cake\ORM\Association\HasMany $Posts
 * @property \Cake\ORM\Association\HasMany $Projects
 * @property \Cake\ORM\Association\HasMany $Reports
 * @property \Cake\ORM\Association\BelongsToMany $Teams
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
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
        $this->hasMany('Notes', [
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
        $this->belongsToMany('Teams', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'team_id',
            'joinTable' => 'teams_users'
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
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('email')
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
                'message' => __d('elabs', 'Your password does not match your confirm password. Please try again'),
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
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('file_count')
            ->requirePresence('file_count', 'create')
            ->notEmpty('file_count');

        $validator
            ->integer('note_count')
            ->requirePresence('note_count', 'create')
            ->notEmpty('note_count');

        $validator
            ->integer('post_count')
            ->requirePresence('post_count', 'create')
            ->notEmpty('post_count');

        $validator
            ->integer('project_count')
            ->requirePresence('project_count', 'create')
            ->notEmpty('project_count');

        $validator
            ->requirePresence('preferences', 'create')
            ->notEmpty('preferences');

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
