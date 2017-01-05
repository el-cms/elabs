<?php

namespace App\Model\Table;

use CakeDC\Users\Model\Table\UsersTable as BaseTable;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Files
 * @property \Cake\ORM\Association\HasMany $Notes
 * @property \Cake\ORM\Association\HasMany $Posts
 * @property \Cake\ORM\Association\HasMany $Projects
 * @property \Cake\ORM\Association\HasMany $Reports
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends BaseTable
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

        $this->table('users');
        $this->displayField('username');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Files', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Reports', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Albums', [
            'foreignKey' => 'user_id'
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
        $validator = parent::validationDefault($validator);

        /*
         * Only the fields that differs from the CakeDC/Users plugin are validated here.
         */
        $validator
                ->allowEmpty('website');

        $validator
                ->allowEmpty('bio');

        $validator->allowEmpty('file_count')
                ->allowEmpty('note_count')
                ->allowEmpty('post_count')
                ->allowEmpty('album_count')
                ->allowEmpty('project_count');

        $validator->allowEmpty('preferences');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }

    /**
     * Finds all data for an user
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options:
     *   - allContain bool, default false. Selects all relationships
     *   - allStatuses bool, default true. Overrides status limitation
     *   - complete bool, default false. Select all the fields
     *   - sfw bool, default false. Limits the result to sfw items
     *   - withAlbums bool, default true. Select the albums
     *   - withFiles bool, default true. Select the files
     *   - withNotes bool, default false. Select the notess
     *   - withPosts bool, default false. Select the posts
     *   - withProjects bool, default false. Select the projects
     *
     * @return \Cake\ORM\Query
     */
    public function findWithContain(\Cake\ORM\Query $query, array $options = [])
    {
        $options += [
            'allContain' => false,
            'allStatuses' => false,
            'complete' => false,
            'sfw' => true,
            'withAlbums' => false,
            'withFiles' => false,
            'withNotes' => false,
            'withPosts' => false,
            'withProjects' => false,
        ];

        if ($options['allContain'] === true) {
            $options = [
                'withAlbums' => true,
                'withFiles' => true,
                'withNotes' => true,
                'withPosts' => true,
                'withProjects' => true,
                    ] + $options;
        }

        $where = [];

        // Conditions
        if ($options['allStatuses'] === false) {
            $where = ['OR' => [['active' => STATUS_ACTIVE], ['active' => STATUS_LOCKED]]];
        }

        // fields;
        $query->select(['id', 'username', 'first_name', 'last_name', 'email', 'website', 'created', 'active', 'role', 'post_count', 'project_count', 'file_count', 'note_count', 'album_count'])
                ->where($where);
        if ($options['complete'] === true) {
            $query->select(['bio']);
        }

        $sfw = $options['sfw'];
        // Relations
        if ($options['withAlbums']) {
            $query->contain(['Albums' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['pivot' => 'ProjectsAlbums.album_id', 'sfw' => $sfw]);
            }]);
        }
        if ($options['withFiles']) {
            $query->contain(['Files' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['pivot' => 'ProjectsFiles.file_id', 'sfw' => $sfw]);
            }]);
        }
        if ($options['withNotes']) {
            $query->contain(['Notes' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['pivot' => 'ProjectsNotes.note_id', 'sfw' => $sfw]);
            }]);
        }
        if ($options['withPosts']) {
            $query->contain(['Posts' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['pivot' => 'ProjectsPosts.post_id', 'sfw' => $sfw]);
            }]);
        }
        if ($options['withProjects']) {
            $query->contain(['Projects' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw]);
            }]);
        }

        // Returns the query
        return $query;
    }

    /**
     * Used to fetch minimal data about users on contained items
     * (i.e: user of a file)
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

        $fields = ['id', 'first_name', 'last_name', 'username'];
        if (!is_null($options['pivot'])) {
            $fields[] = $options['pivot'];
        }

        return $query->select($fields);
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
                        ->where(['Users.id' => $primaryKey])
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
