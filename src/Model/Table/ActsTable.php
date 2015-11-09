<?php

namespace App\Model\Table;

use App\Model\Entity\Act;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Acts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ActsTable extends Table
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

        $this->table('acts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Posts', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Posts'],
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Projects'],
        ]);
        $this->belongsTo('Files', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Files'],
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
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('model', 'create')
                ->notEmpty('model');

        $validator
                ->add('fkid', 'valid', ['rule' => 'uuid'])
                ->requirePresence('fkid', 'create')
                ->notEmpty('fkid');

        $validator
                ->requirePresence('type', 'create')
                ->notEmpty('type');

        return $validator;
    }

}
