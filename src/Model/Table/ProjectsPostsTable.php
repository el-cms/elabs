<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectsPosts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Projects
 * @property \Cake\ORM\Association\BelongsTo $Posts
 *
 * @method \App\Model\Entity\ProjectsPost get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectsPost newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProjectsPost[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectsPost|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectsPost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectsPost[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectsPost findOrCreate($search, callable $callback = null)
 */
class ProjectsPostsTable extends Table
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

        $this->table('projects_posts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('CounterCache', [
            'Projects' => ['post_count' => [
                'contain' => ['Posts'],
                'conditions' => ['Posts.status' => STATUS_PUBLISHED]]],
        ]);

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id',
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
        $rules->add($rules->existsIn(['post_id'], 'Posts'));

        return $rules;
    }
}
