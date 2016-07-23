<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Languages Model
 *
 * @property \Cake\ORM\Association\HasMany $Files
 * @property \Cake\ORM\Association\HasMany $Posts
 * @property \Cake\ORM\Association\HasMany $Projects
 *
 * @method \App\Model\Entity\Language get($primaryKey, $options = [])
 * @method \App\Model\Entity\Language newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Language[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Language|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Language patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Language[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Language findOrCreate($search, callable $callback = null)
 */
class LanguagesTable extends Table
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

        $this->table('languages');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Files', [
            'foreignKey' => 'language_id'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'language_id'
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'language_id'
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
                ->notEmpty('id', 'create')
                ->notEmpty('id');

        $validator
                ->requirePresence('iso639_1', 'create')
                ->notEmpty('iso639_1');

        $validator
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->integer('post_count')
                ->requirePresence('post_count', 'create')
                ->notEmpty('post_count');

        $validator
                ->integer('project_count')
                ->requirePresence('project_count', 'create')
                ->notEmpty('project_count');

        $validator
                ->integer('file_count')
                ->requirePresence('file_count', 'create')
                ->notEmpty('file_count');

        return $validator;
    }
}
