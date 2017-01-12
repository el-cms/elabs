<?php

namespace App\Model\Table;

use App\Model\Entity\Album;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\BelongsToMany;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Albums Model
 *
 * @property BelongsTo $Users
 * @property BelongsTo $Languages
 * @property BelongsToMany $Files
 * @property BelongsToMany $Tags
 * @property BelongsToMany $Projects
 * @property HasMany $Acts
 *
 * @method Album get($primaryKey, $options = [])
 * @method Album newEntity($data = null, array $options = [])
 * @method Album[] newEntities(array $data, array $options = [])
 * @method Album|bool save(EntityInterface $entity, $options = [])
 * @method Album patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Album[] patchEntities($entities, array $data, array $options = [])
 * @method Album findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class AlbumsTable extends Table
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

        $this->table('albums');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Users' => ['album_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
            'Languages' => ['album_count' => ['conditions' => ['status' => STATUS_PUBLISHED]]],
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
            'foreignKey' => 'album_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'albums_files'
        ]);
        $this->belongsToMany('Projects', [
            'foreignKey' => 'album_id',
            'targetForeignKey' => 'project_id',
            'joinTable' => 'projects_albums'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'album_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'albums_tags'
        ]);
        $this->hasMany('Acts', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Albums']
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
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
                ->allowEmpty('description');

        $validator
                ->boolean('sfw')
                ->requirePresence('sfw', 'create')
                ->notEmpty('sfw');

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
     * @param RulesChecker $rules The rules object to be modified.
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['language_id'], 'Languages'));

        return $rules;
    }

    /**
     * Finds all data for an album
     *
     * @param Query $query The query
     * @param array $options An array of options:
     *   - allStatuses bool, default true. Overrides status limitation
     *   - forceOrder bool, default true. If true, no order will be applied
     *   - order array, default created, desc. Default sort order
     *   - sfw bool, default false. Limits the result to sfw items
     *   - uid string, default null. Select only items for this user
     *   - withFiles bool, default true. Select the files
     *   - withLanguages bool, default true. Select the language
     *   - withProjects bool, default false. Select the projects
     *   - withTags bool, default false. Select the tags
     *   - withUsers bool, default true. Select the user
     *
     * @return Query
     */
    public function findWithContain(Query $query, array $options = [])
    {
        $options += [
            'allStatuses' => false,
            'sfw' => true,
            'forceOrder' => false,
            'order' => ['Albums.created' => 'desc'],
            'uid' => null,
            'withFiles' => true,
            'withLanguages' => true,
            'withProjects' => true,
            'withTags' => true,
            'withUsers' => true,
        ];

        $where = [];

        // Conditions
        if ($options['allStatuses'] === false) {
            $where = ['Albums.status' => STATUS_PUBLISHED];
        }
        if ($options['sfw'] === true) {
            $where['Albums.sfw'] = true;
        }
        if (!is_null($options['uid'])) {
            $where['Albums.user_id'] = $options['uid'];
        }

        // Fields
        $query->select(['id', 'name', 'description', 'status', 'created', 'modified', 'sfw', 'user_id', 'language_id'])
                ->where($where);

        // Order
        if ($options['forceOrder']) {
            $query->order($options['order']);
        }

        // Relations
        $containLimit = Configure::read('cms.maxRelatedData');
        if ($options['withFiles']) {
            $query->contain(['Files' => function ($q) use ($containLimit) {
                    return $q->find('asContain', ['pivot' => 'AlbumsFiles.file_id']);
            }]);
        }
        if ($options['withLanguages']) {
            $query->contain(['Languages' => function ($q) {
                    return $q->find('asContain');
            }]);
        }
        if ($options['withProjects']) {
            $query->contain(['Projects' => function ($q) {
                    return $q->find('asContain', ['pivot' => 'ProjectsAlbums.project_id']);
            }]);
        }
        if ($options['withTags']) {
            $query->contain(['Tags' => function ($q) {
                    return $q->find('asContain', ['pivot' => ['AlbumsTags.tag_id']]);
            }]);
        }
        if ($options['withUsers']) {
            $query->contain(['Users' => function ($q) {
                    return $q->find('asContain');
            }]);
        }

        // Return the query
        return $query;
    }

    /**
     * Runs findWithContain with all statuses and nsfw entries, for content owned
     * by an user. The uid option is required.
     *
     * @param Query $query The query
     * @param array $options An array of options. See findWithContain()
     *   - uid string, default null
     *
     * @return Query
     */
    public function findUsers(Query $query, array $options = [])
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
     * Used to fetch minimal data about albums
     *
     * @param Query $query The query
     * @param array $options An array of options. Don't forget to add the 'pivot'
     *        field name if necessary
     *
     * @return Query
     */
    public function findAsContain(Query $query, array $options = [])
    {
        $options += ['pivot' => null];

        $fields = ['id', 'name']; //, 'created', 'modified', 'sfw', 'user_id', 'language_id'];
        if (!is_null($options['pivot'])) {
            $fields[] = $options['pivot'];
        }

        return $query->select($fields)
                        // Define order as there may be multiple results
                        ->order(['Albums.created' => 'desc']);
    }

    /**
     * Gets a record with associated data. Throw an exception if the record is not found.
     *
     * @param mixed $primaryKey The primary key to fetch
     * @param array $options An array of options:
     *   - sfw bool, default true Limit to sfw data
     *
     * @return Entity
     */
    public function getWithContain($primaryKey, array $options = [])
    {
        $options += ['sfw' => true];

        return $this->find('withContain', $options)
                        ->where(['Albums.id' => $primaryKey])
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
     * @return Entity
     */
    public function getWithoutContain($primaryKey, array $options = [])
    {
        $options += [
            'sfw' => true,
        ];

        return $this->find('asContain', $options)
                        ->where(['Albums.id' => $primaryKey])
                        ->firstOrFail();
    }

    /**
     * Runs findWithContain with all statuses and nsfw entries
     *
     * @param Query $query The query
     * @param array $options An array of options. See findWithContain()
     *
     * @return Query
     */
    public function findAdminWithContain(Query $query, array $options = [])
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
     * @return Entity
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
