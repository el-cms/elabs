<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Licenses
 * @property \Cake\ORM\Association\BelongsTo $Languages
 * @property \Cake\ORM\Association\BelongsToMany $Tags
 * @property \Cake\ORM\Association\BelongsToMany $Projects
 * @property \Cake\ORM\Association\HasMany $Acts
 *
 * @method \App\Model\Entity\Post get($primaryKey, $options = [])
 * @method \App\Model\Entity\Post newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Post[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Post|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Post[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Post findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class PostsTable extends Table
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

        $this->table('posts');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('CounterCache', [
            'Users' => ['post_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
            'Licenses' => ['post_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
            'Languages' => ['post_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Licenses', [
            'foreignKey' => 'license_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'posts_tags'
        ]);
        $this->belongsToMany('Projects', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'project_id',
            'joinTable' => 'projects_posts'
        ]);
        $this->hasMany('Acts', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Posts']
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
                ->requirePresence('title', 'create')
                ->notEmpty('title');

        $validator
                ->requirePresence('excerpt', 'create')
                ->notEmpty('excerpt')
                ->add('excerpt', [
                    'maxLength' => [
                        'rule' => ['maxLength', 250],
                        'message' => 'Excerpts cannot be too long.'
                    ]
        ]);

        $validator
                ->allowEmpty('text');

        $validator
                ->boolean('sfw')
                ->requirePresence('sfw', 'create')
                ->notEmpty('sfw');

        $validator
                ->integer('status')
                ->requirePresence('status', 'create')
                ->notEmpty('status');

        $validator
                ->dateTime('publication_date')
                ->allowEmpty('publication_date');

        $validator
                ->boolean('hide_from_acts')
                ->requirePresence('hide_from_acts', 'create')
                ->notEmpty('hide_from_acts');

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
        $rules->add($rules->existsIn(['language_id'], 'Languages'));

        return $rules;
    }

    public function findWithContain(\Cake\ORM\Query $query, array $options = [])
    {
        $options += [
            'sfw' => true,
            'withUsers' => true,
            'withLicenses' => true,
            'withLanguages' => true,
            'withProjects' => true,
        ];

        $where = ['Posts.status' => STATUS_PUBLISHED];
        if ($options['sfw'] === true) {
            $where['Posts.sfw'] = true;
        }
        
        $query->select(['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id', 'created', 'license_id', 'language_id'])
                ->where($where);

        if ($options['withLicenses']) {
            $query->contain(['Licenses' => function ($q) {
                    return $q->find('asContain');
                }]);
        }
        if ($options['withLanguages']) {
            $query->contain(['Languages' => function ($q) {
                    return $q->find('asContain');
                }]);
        }
        if ($options['withUsers']) {
            $query->contain(['Users' => function ($q) {
                    return $q->find('asContain');
                }]);
        }
        if ($options['withProjects']) {
            $query->contain(['Projects' => function($q) {
                    return $q->find('asContain', ['pivot' => 'ProjectsPosts.post_id']);
                }]);
        }

        return $query;
    }
}
