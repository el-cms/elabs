<?php

namespace App\Model\Table;

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
            'Users' => ['file_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
            'Licenses' => ['file_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
            'Languages' => ['file_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
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
        $rules->add($rules->existsIn(['language_id'], 'Languages'));
        $rules->add($rules->existsIn(['license_id'], 'Licenses'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    /**
     * Finds all data for a file
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options:
     *   - allStatuses bool, default true. Overrides status limitation
     *   - forceOrder bool, default true. If true, no order will be applied
     *   - order array, default created, desc. Default sort order
     *   - sfw bool, default false. Limits the result to sfw items
     *   - uid string, default null. Select only items for this user
     *   - withAlbums bool, default true. Select the albums
     *   - withLanguages bool, dafault true. Select the language
     *   - withLicenses bool, dafault true. Select the license
     *   - withProjects bool, default false. Select the projects
     *   - withTags bool, default false. Select the tags
     *   - withUsers bool, default true. Select the user
     *
     * @return \Cake\ORM\Query
     */
    public function findWithContain(\Cake\ORM\Query $query, array $options = [])
    {
        $options += [
            'allStatuses' => false,
            'forceOrder' => false,
            'order' => ['Files.created' => 'desc'],
            'sfw' => true,
            'uid' => null,
            'withAlbums' => true,
            'withLanguages' => true,
            'withLicenses' => true,
            'withProjects' => true,
            'withTags' => true,
            'withUsers' => true,
        ];

        $where = [];

        // Conditions
        if ($options['allStatuses'] === false) {
            $where = ['Files.status' => STATUS_PUBLISHED];
        }
        if ($options['sfw'] === true) {
            $where['Files.sfw'] = true;
        }
        if (!is_null($options['uid'])) {
            $where['Files.user_id'] = $options['uid'];
        }

        // Fields
        $query->select(['id', 'name', 'description', 'filename', 'weight', 'created', 'modified', 'sfw', 'status', 'user_id', 'license_id', 'language_id'])
                ->where($where);

        // Order
        if ($options['forceOrder']) {
            $query->order($options['order']);
        }

        // Relations
        if ($options['withAlbums']) {
            $query->contain(['Albums' => function ($q) {
                    return $q->find('asContain', ['pivot' => 'AlbumsFiles.album_id']);
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
        if ($options['withProjects']) {
            $query->contain(['Projects' => function ($q) {
                    return $q->find('asContain', ['pivot' => 'ProjectsFiles.file_id']);
            }]);
        }
        if ($options['withTags']) {
            $query->contain(['Tags' => function ($q) {
                    return $q->find('asContain', ['pivot' => ['FilesTags.file_id']]);
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
     * Used to fetch minimal data about files
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

        $fields = ['id', 'name', 'description', 'filename', 'created', 'modified', 'sfw', 'user_id', 'license_id', 'language_id'];
        if (!is_null($options['pivot'])) {
            $fields[] = $options['pivot'];
        }

        return $query->select($fields)
                    // Define order as there may be multiple results
                    ->order(['Files.created' => 'desc']);
    }

    /**
     * Gets a record with associated data. Throw an exception if the record is not found.
     *
     * @param mixed $primaryKey The primary key to fetch
     * @param array $options An array of options:
     *   - sfw bool, default true Limit to sfw data
     *
     * @return \Cake\ORM\Entity
     */
    public function getWithContain($primaryKey, array $options = [])
    {
        $options += ['sfw' => true];

        return $this->find('withContain', $options)
                        ->where(['Files.id' => $primaryKey])
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
                        ->where(['Files.id' => $primaryKey])
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
}
