<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectsAlbums Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Projects
 * @property \Cake\ORM\Association\BelongsTo $Albums
 *
 * @method \App\Model\Entity\ProjectsAlbum get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectsAlbum newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProjectsAlbum[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectsAlbum|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectsAlbum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectsAlbum[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectsAlbum findOrCreate($search, callable $callback = null)
 */
class ProjectsAlbumsTable extends Table
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

        $this->table('projects_albums');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('CounterCache', [
            'Projects' => ['album_count' => [
                    'contain' => ['Albums'],
                    'conditions' => ['Albums.status' => STATUS_PUBLISHED]]],
        ]);

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Albums', [
            'foreignKey' => 'album_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['project_id'], 'Projects'));
        $rules->add($rules->existsIn(['album_id'], 'Albums'));

        return $rules;
    }
}
