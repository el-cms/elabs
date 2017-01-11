<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Licenses Model
 *
 * @property \Cake\ORM\Association\HasMany $Files
 * @property \Cake\ORM\Association\HasMany $Notes
 * @property \Cake\ORM\Association\HasMany $Posts
 * @property \Cake\ORM\Association\HasMany $Projects
 *
 * @method \App\Model\Entity\License get($primaryKey, $options = [])
 * @method \App\Model\Entity\License newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\License[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\License|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\License patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\License[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\License findOrCreate($search, callable $callback = null)
 */
class LicensesTable extends Table
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

        $this->table('licenses');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Files', [
            'foreignKey' => 'license_id'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'license_id'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'license_id'
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'license_id'
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

        $validator
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->allowEmpty('link');

        $validator
                ->allowEmpty('icon');

        $validator
                ->integer('file_count')
                ->requirePresence('file_count', 'create')
                ->notEmpty('file_count');

        $validator
                ->integer('post_count')
                ->requirePresence('post_count', 'create')
                ->notEmpty('post_count');

        $validator
                ->integer('project_count')
                ->requirePresence('project_count', 'create')
                ->notEmpty('project_count');

        $validator
                ->integer('note_count')
                ->requirePresence('note_count', 'create')
                ->notEmpty('note_count');

        return $validator;
    }

    /**
     * Finds all data for a license
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options:
     *   - sfw bool, default false. Limits the content to sfw items
     *   - withFiles bool, default true. Select the files
     *   - withNotes bool, default true. Select the notes
     *   - withPosts bool, default true. Select the posts
     *   - withProjects bool, default false. Select the projects
     *
     * @return \Cake\ORM\Query
     */
    public function findWithContain(\Cake\ORM\Query $query, array $options = [])
    {
        $options += [
            'sfw' => true,
            'withFiles' => true,
            'withNotes' => true,
            'withPosts' => true,
            'withProjects' => true,
        ];

        $sfw = $options['sfw'];
        $query->select(['id', 'name', 'link', 'icon', 'file_count', 'note_count', 'post_count', 'project_count']);

        if ($options['withFiles'] === true) {
            $query->contain(['Files' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw, 'withLicenses' => false, 'forceOrder' => true]);
            }]);
        }
        if ($options['withNotes'] === true) {
            $query->contain(['Notes' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw, 'withLicenses' => false, 'forceOrder' => true]);
            }]);
        }
        if ($options['withPosts'] === true) {
            $query->contain(['Posts' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw, 'withLicenses' => false, 'forceOrder' => true]);
            }]);
        }
        if ($options['withProjects'] === true) {
            $query->contain(['Projects' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw, 'withLicenses' => false, 'forceOrder' => true]);
            }]);
        }

        return $query;
    }

    /**
     * Used to fetch minimal data about licenses
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options. Don't forget to add the 'pivot'
     *        field name if necessary
     *
     * @return \Cake\ORM\Query
     */
    public function findAsContain(\Cake\ORM\Query $query, array $options = [])
    {
        return $query->select(['id', 'name', 'icon', 'link'])
                        // Define order as there may be multiple results
                        ->order(['Licenses.name' => 'desc']);
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
                        ->where(['Licenses.id' => $primaryKey])
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
                        ->where(['Licenses.id' => $primaryKey])
                        ->firstOrFail();
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
