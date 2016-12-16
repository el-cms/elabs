<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Comments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Comment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Comment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Comment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Comment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Comment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Comment findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommentsTable extends Table
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

        $this->table('comments');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);

        $this->belongsTo('Files', [
            'foreignKey' => 'fkid',
            'conditions' => ['Comments.model' => 'Files'],
        ]);
        $this->belongsTo('Notes', [
            'foreignKey' => 'fkid',
            'conditions' => ['Comments.model' => 'Notes'],
        ]);
        $this->belongsTo('Posts', [
            'foreignKey' => 'fkid',
            'conditions' => ['Comments.model' => 'Posts'],
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'fkid',
            'conditions' => ['Comments.model' => 'Projects'],
        ]);
        $this->belongsTo('Albums', [
            'foreignKey' => 'fkid',
            'conditions' => ['Comments.model' => 'Albums'],
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
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('model', 'create')
                ->notEmpty('model');

        $validator
                ->uuid('fkid')
                ->requirePresence('fkid', 'create')
                ->notEmpty('fkid');

        $validator
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->email('email')
                ->requirePresence('email', 'create')
                ->notEmpty('email');

        $validator
                ->boolean('allow_contact')
                ->requirePresence('allow_contact', 'create')
                ->notEmpty('allow_contact');

        $validator
                ->requirePresence('message', 'create')
                ->notEmpty('message');

        return $validator;
    }
}
