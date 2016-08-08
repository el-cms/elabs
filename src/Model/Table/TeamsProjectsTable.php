<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TeamsProjects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Teams
 * @property \Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\TeamsProject get($primaryKey, $options = [])
 * @method \App\Model\Entity\TeamsProject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TeamsProject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TeamsProject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TeamsProject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TeamsProject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TeamsProject findOrCreate($search, callable $callback = null)
 */
class TeamsProjectsTable extends Table
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

        $this->table('teams_projects');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
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
        $rules->add($rules->existsIn(['team_id'], 'Teams'));
        $rules->add($rules->existsIn(['project_id'], 'Projects'));

        return $rules;
    }
}
