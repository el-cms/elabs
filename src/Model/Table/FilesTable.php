<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Files Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Languages
 * @property \Cake\ORM\Association\BelongsTo $Licenses
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsToMany $Tags
 * @property \Cake\ORM\Association\BelongsToMany $Projects
 * @property \Cake\ORM\Association\BelongsToMany $Albums
 * @property \Cake\ORM\Association\HasMany $Acts
 *
 * @method \App\Model\Entity\File get($primaryKey, $options = [])
 * @method \App\Model\Entity\File newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\File[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\File|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\File[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\File findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
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
            'Users' => ['file_count' => ['conditions' => ['status' => 1]]],
            'Licenses' => ['file_count' => ['conditions' => ['status' => 1]]],
            'Languages' => ['file_count' => ['conditions' => ['status' => 1]]],
        ]);

        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Licenses', [
            'foreignKey' => 'license_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'file_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'files_tags'
        ]);
        $this->belongsToMany('Projects', [
            'foreignKey' => 'file_id',
            'targetForeignKey' => 'project_id',
            'joinTable' => 'projects_files'
        ]);
        $this->belongsToMany('Albums', [
            'foreignKey' => 'file_id',
            'targetForeignKey' => 'album_id',
            'joinTable' => 'albums_files'
        ]);
        $this->hasMany('Acts', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Files']
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
                ->allowEmpty('name');

        $validator
                ->requirePresence('filename', 'create')
                ->notEmpty('filename');

        $validator
                ->integer('weight')
                ->requirePresence('weight', 'create')
                ->notEmpty('weight');

        $validator
                ->allowEmpty('description');

        $validator
                ->requirePresence('mime', 'create')
                ->notEmpty('mime');

        $validator
            ->boolean('sfw')
            ->requirePresence('sfw', 'create')
            ->notEmpty('sfw');

        $validator
            ->integer('status')
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
        $rules->add($rules->existsIn(['language_id'], 'Languages'));
        $rules->add($rules->existsIn(['license_id'], 'Licenses'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
