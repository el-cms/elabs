<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Licenses
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Languages
 * @property \Cake\ORM\Association\BelongsToMany $Albums
 * @property \Cake\ORM\Association\BelongsToMany $Files
 * @property \Cake\ORM\Association\BelongsToMany $Notes
 * @property \Cake\ORM\Association\BelongsToMany $Posts
 * @property \Cake\ORM\Association\BelongsToMany $Tags
 * @property \Cake\ORM\Association\HasMany $Acts
 *
 * @method \App\Model\Entity\Project get($primaryKey, $options = [])
 * @method \App\Model\Entity\Project newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Project[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Project|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Project[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Project findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class ProjectsTable extends Table
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

        $this->table('projects');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Users' => ['project_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
            'Licenses' => ['project_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
            'Languages' => ['project_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
        ]);

        $this->belongsTo('Licenses', [
            'foreignKey' => 'license_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Files', [
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'projects_files'
        ]);
        $this->belongsToMany('Notes', [
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'note_id',
            'joinTable' => 'projects_notes'
        ]);
        $this->belongsToMany('Posts', [
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'post_id',
            'joinTable' => 'projects_posts'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'projects_tags'
        ]);
        $this->belongsToMany('Albums', [
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'album_id',
            'joinTable' => 'projects_albums'
        ]);
        $this->hasMany('Acts', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Projects']
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
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->allowEmpty('short_description');

        $validator
                ->allowEmpty('description');

        $validator
                ->allowEmpty('mainurl');

        $validator
                ->boolean('sfw')
                ->requirePresence('sfw', 'create')
                ->notEmpty('sfw');

        $validator
                ->integer('status')
                ->requirePresence('status', 'create')
                ->notEmpty('status');

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
        $rules->add($rules->existsIn(['license_id'], 'Licenses'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['language_id'], 'Languages'));

        return $rules;
    }

    /**
     * Finds all data for a project. By default, relation as posts, albums,... are
     * not included in the result.
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options:
     *   - allStatuses bool, default true. Overrides status limitation
     *   - complete bool, default false. Select all the fields
     *   - forceOrder bool, default true. If true, no order will be applied
     *   - order array, default created, desc. Default sort order
     *   - sfw bool, default false. Limits the result to sfw items
     *   - uid string, default null. Select only items for this user
     *   - withAlbums bool, default false. Select the albums
     *   - withFiles bool, default false. Select the files
     *   - withLanguages bool, default true. Select the language
     *   - withLicenses bool, default true. Select the licenses
     *   - withNotes bool, default false. Select the notess
     *   - withPosts bool, default false. Select the posts
     *   - withTags bool, default false. Select the tags
     *   - withUsers bool, default true. Select the user
     *
     * @return \Cake\ORM\Query
     */
    public function findWithContain(\Cake\ORM\Query $query, array $options = [])
    {
        $options += [
            'allStatuses' => false,
            'complete' => false,
            'forceOrder' => false,
            'order' => ['Projects.created' => 'desc'],
            'sfw' => true,
            'uid' => null,
            'withAlbums' => false,
            'withFiles' => false,
            'withLanguages' => true,
            'withLicenses' => true,
            'withNotes' => false,
            'withPosts' => false,
            'withTags' => true,
            'withUsers' => true,
        ];

        $sfw = $options['sfw'];

        $where = [];

        // Conditions
        if ($options['allStatuses'] === false) {
            $where = ['Projects.status' => STATUS_PUBLISHED];
        }
        if ($options['sfw'] === true) {
            $where['Projects.sfw'] = true;
        }
        if (!is_null($options['uid'])) {
            $where['Projects.user_id'] = $options['uid'];
        }

        // fields;
        $query->select(['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'status', 'user_id', 'license_id', 'language_id'])
                ->where($where);
        if ($options['complete'] === true) {
            $query->select(['description', 'album_count', 'file_count', 'note_count', 'post_count']);
        }

        // Order
        if ($options['forceOrder']) {
            $query->order($options['order']);
        }

        // Relations
        if ($options['withAlbums']) {
            $query->contain(['Albums' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['pivot' => 'ProjectsAlbums.album_id', 'sfw' => $sfw, 'forceOrder' => true]);
            }]);
        }
        if ($options['withFiles']) {
            $query->contain(['Files' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['pivot' => 'ProjectsFiles.file_id', 'sfw' => $sfw, 'forceOrder' => true]);
            }]);
        }
        if ($options['withLanguages']) {
            $query->contain(['Languages' => function ($q) {
                    return $q->find('asContain');
            }]);
        }
        if ($options['withLicenses']) {
            $query->contain(['Licenses' => function ($q) {
                    return $q->find('asContain');
            }]);
        }
        if ($options['withNotes']) {
            $query->contain(['Notes' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['pivot' => 'ProjectsNotes.note_id', 'sfw' => $sfw, 'forceOrder' => true]);
            }]);
        }
        if ($options['withPosts']) {
            $query->contain(['Posts' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['pivot' => 'ProjectsPosts.post_id', 'sfw' => $sfw, 'forceOrder' => true]);
            }]);
        }
        if ($options['withTags']) {
            $query->contain(['Tags' => function ($q) {
                    return $q->find('asContain', ['pivot' => ['ProjectsTags.project_id'], 'forceOrder' => true]);
            }]);
        }
        if ($options['withUsers']) {
            $query->contain(['Users' => function ($q) {
                    return $q->find('asContain');
            }]);
        }

        // Returns the query
        return $query;
    }

    /**
     * Runs findWithContain with all statuses and nsfw entries, for content owned
     * by an user. The uid option is required.
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options. See findWithContain()
     *   - uid string, default null
     *
     * @return \Cake\ORM\Query
     */
    public function findUsers(\Cake\ORM\Query $query, array $options = [])
    {
        // Override options
        $queryOptions = [
            'sfw' => false,
            'allStatuses' => true,
                ] + $options + [
                    'uid' => null
                ];

        return $this->findWithContain($query, $queryOptions);
    }

    /**
     * Used to fetch minimal data about projects
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options. Don't forget to add the 'pivot'
     *        field name if necessary
     *
     * @return \Cake\ORM\Query
     */
    public function findAsContain(\Cake\ORM\Query $query, array $options = [])
    {
        $options += ['pivot' => null];

        $fields = ['id', 'name'];
        if (!is_null($options['pivot'])) {
            $fields[] = $options['pivot'];
        }

        return $query->select($fields)
                        // Define order as there may be multiple results
                        ->order(['Projects.created' => 'desc']);
    }

    /**
     * Gets a record with associated data. Throw an exception if the record is not found.
     *
     * @param mixed $primaryKey The primary key to fetch
     * @param array $options An array of options:
     *   - sfw bool, default true Limit to sfw data
     *   - complete bool default true Select all the fields
     *
     * @return \Cake\ORM\Entity
     */
    public function getWithContain($primaryKey, array $options = [])
    {
        $options += [
            'sfw' => true,
            'complete' => true,
        ];

        return $this->find('withContain', $options)
                        ->where(['Projects.id' => $primaryKey])
                        ->firstOrFail();
    }

    /**
     * Gets a record without associated data. Throw an exception if the record is not found.
     *
     * @param mixed $primaryKey The primary key to fetch
     * @param array $options An array of options:
     *   - sfw bool, default true Limit to sfw data
     *   - complete bool default true Select all the fields
     *
     * @return \Cake\ORM\Entity
     */
    public function getWithoutContain($primaryKey, array $options = [])
    {
        $options += [
            'sfw' => true,
        ];

        return $this->find('asContain', $options)
                        ->where(['Projects.id' => $primaryKey])
                        ->firstOrFail();
    }

    /**
     * Runs findWithContain with all statuses and nsfw entries
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options. See findWithContain()
     *
     * @return \Cake\ORM\Query
     */
    public function findAdminWithContain(\Cake\ORM\Query $query, array $options = [])
    {
        // Force options
        $options['sfw'] = false;
        $options['allStatuses'] = true;

        return $this->findWithContain($query, $options);
    }

    /**
     * Runs getWithContain with all statuses and nsfw entries
     *
     * @param type $primaryKey The primary key to fetch
     * @param array $options An array of options
     *
     * @return \Cake\ORM\Entity
     */
    public function getAdminWithContain($primaryKey, array $options = [])
    {
        //Override passed options
        $options['sfw'] = false;
        $options['allStatuses'] = true;

        return $this->getWithContain($primaryKey, $options);
    }

    /**
     * Returns a list sorted by name
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options
     *
     * @return \Cake\ORM\Query
     */
    public function findList(\Cake\ORM\Query $query, array $options)
    {
        return parent::findList($query, $options)
                ->order('name', 'desc');
    }
}
