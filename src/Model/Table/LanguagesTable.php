<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Languages Model
 *
 * @property \Cake\ORM\Association\HasMany $Files
 * @property \Cake\ORM\Association\HasMany $Notes
 * @property \Cake\ORM\Association\HasMany $Posts
 * @property \Cake\ORM\Association\HasMany $Projects
 * @property \Cake\ORM\Association\HasMany $Albums
 *
 * @method \App\Model\Entity\Language get($primaryKey, $options = [])
 * @method \App\Model\Entity\Language newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Language[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Language|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Language patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Language[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Language findOrCreate($search, callable $callback = null)
 */
class LanguagesTable extends Table
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

        $this->table('languages');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Files', [
            'foreignKey' => 'language_id'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'language_id'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'language_id'
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'language_id'
        ]);
        $this->hasMany('Albums', [
            'foreignKey' => 'language_id'
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
                ->notEmpty('id', 'create')
                ->notEmpty('id');

        $validator
                ->requirePresence('iso639_1', 'create')
                ->notEmpty('iso639_1');

        $validator
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->boolean('has_site_translation')
                ->requirePresence('has_site_translation', 'create')
                ->notEmpty('has_site_translation');

        $validator
                ->allowEmpty('translation_folder');

        $validator
                ->integer('file_count')
                ->requirePresence('file_count', 'create')
                ->notEmpty('file_count');

        $validator
                ->integer('note_count')
                ->requirePresence('note_count', 'create')
                ->notEmpty('note_count');

        $validator
                ->integer('post_count')
                ->requirePresence('post_count', 'create')
                ->notEmpty('post_count');

        $validator
                ->integer('project_count')
                ->requirePresence('project_count', 'create')
                ->notEmpty('project_count');

        return $validator;
    }

    /**
     * Finds all data for a language
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options:
     *   - sfw bool, default false. Limits the result to sfw items
     *   - withAlbums bool, default true. Select the albums
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
            'withAlbums' => true,
            'withFiles' => true,
            'withNotes' => true,
            'withPosts' => true,
            'withProjects' => true,
        ];
        $sfw = $options['sfw'];
        $query->select(['id', 'iso639_1', 'name', 'has_site_translation', 'file_count', 'note_count', 'album_count', 'post_count', 'project_count']);

        if ($options['withAlbums'] === true) {
            $query->contain(['Albums' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw, 'withLanguages' => false]);
            }]);
        }
        if ($options['withFiles'] === true) {
            $query->contain(['Files' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw, 'withLanguages' => false]);
            }]);
        }
        if ($options['withNotes'] === true) {
            $query->contain(['Notes' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw, 'withLanguages' => false]);
            }]);
        }
        if ($options['withPosts'] === true) {
            $query->contain(['Posts' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw, 'withLanguages' => false]);
            }]);
        }
        if ($options['withProjects'] === true) {
            $query->contain(['Projects' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw, 'withLanguages' => false]);
            }]);
        }

        return $query;
    }

    /**
     * Used to fetch minimal data about languages
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options. Don't forget to add the 'pivot'
     *        field name if necessary
     *
     * @return \Cake\ORM\Query
     */
    public function findAsContain(\Cake\ORM\Query $query, array $options = [])
    {
        return $query->select(['id', 'name', 'iso639_1']);
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

        $query = $this->find('withContain', $options)
                ->where(['Languages.id' => $primaryKey]);

        return $query->firstOrFail();
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
                        ->where(['Languages.id' => $primaryKey])
                        ->firstOrFail();
    }
}
