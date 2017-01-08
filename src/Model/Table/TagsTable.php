<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tags Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Files
 * @property \Cake\ORM\Association\BelongsToMany $Notes
 * @property \Cake\ORM\Association\BelongsToMany $Posts
 * @property \Cake\ORM\Association\BelongsToMany $Projects
 *
 * @method \App\Model\Entity\Tag get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tag findOrCreate($search, callable $callback = null)
 */
class TagsTable extends Table
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

        $this->table('tags');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Albums', [
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'album_id',
            'joinTable' => 'albums_tags'
        ]);
        $this->belongsToMany('Files', [
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'files_tags'
        ]);
        $this->belongsToMany('Notes', [
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'note_id',
            'joinTable' => 'notes_tags'
        ]);
        $this->belongsToMany('Posts', [
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'post_id',
            'joinTable' => 'posts_tags'
        ]);
        $this->belongsToMany('Projects', [
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'project_id',
            'joinTable' => 'projects_tags'
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
     * Finds all data for a tag
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
            'withUsers' => true,
        ];
        $sfw = $options['sfw'];

        // Fields
        $query->select(['id', 'album_count', 'file_count', 'note_count', 'post_count', 'project_count']);

        // Relations
        if ($options['withAlbums']) {
            $query->contain(['Albums' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw]);
            }]);
        }
        if ($options['withFiles']) {
            $query->contain(['Files' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw]);
            }]);
        }
        if ($options['withNotes']) {
            $query->contain(['Notes' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw]);
            }]);
        }
        if ($options['withPosts']) {
            $query->contain(['Posts' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw]);
            }]);
        }
        if ($options['withProjects']) {
            $query->contain(['Projects' => function ($q) use ($sfw) {
                    return $q->find('withContain', ['sfw' => $sfw]);
            }]);
        }

        // Return the query
        return $query;
    }

    /**
     * Used to fetch minimal data about tags
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options. Don't forget to add the 'pivot'
     *        field name if necessary
     *
     * @return \Cake\ORM\Query
     */
    public function findAsContain(\Cake\ORM\Query $query, array $options = [])
    {
        return $query->select(['id']);
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
        ];

        return $this->find('withContain', $options)
                        ->where(['Tags.id' => $primaryKey])
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
                        ->where(['Tags.id' => $primaryKey])
                        ->firstOrFail();
    }
}
