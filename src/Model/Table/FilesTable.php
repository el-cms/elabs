<?php
namespace App\Model\Table;

use App\Model\Entity\File;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Files Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Licenses
 * @property \Cake\ORM\Association\HasMany $Itemfiles
 */
class FilesTable extends Table
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

        $this->table('files');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Users' => ['post_count' => ['conditions' => ['status' => 1]]],
            'Licenses' => ['post_count' => ['conditions' => ['status' => 1]]],
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Licenses', [
            'foreignKey' => 'license_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Itemfiles', [
            'foreignKey' => 'file_id'
        ]);
        
        $this->hasMany('Acts', [
            'foreignKey'=>'fkid',
            'conditions'=>['Acts.model'=>'Files']
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
            ->allowEmpty('name');

        $validator
            ->requirePresence('filename', 'create')
            ->notEmpty('filename');

        $validator
            ->add('weight', 'valid', ['rule' => 'numeric'])
            ->requirePresence('weight', 'create')
            ->notEmpty('weight');

        $validator
            ->allowEmpty('description');

        $validator
            ->requirePresence('mime', 'create')
            ->notEmpty('mime');

        $validator
            ->add('sfw', 'valid', ['rule' => 'boolean'])
            ->requirePresence('sfw', 'create')
            ->notEmpty('sfw');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['license_id'], 'Licenses'));
        return $rules;
    }
}
