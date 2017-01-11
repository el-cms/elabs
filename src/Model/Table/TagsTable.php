<?php

namespace App\Model\Table;

use App\Model\Entity\Tag;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsToMany;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tags Model
 *
 * @property BelongsToMany $Files
 * @property BelongsToMany $Notes
 * @property BelongsToMany $Posts
 * @property BelongsToMany $Projects
 *
 * @method Tag get($primaryKey, $options = [])
 * @method Tag newEntity($data = null, array $options = [])
 * @method Tag[] newEntities(array $data, array $options = [])
 * @method Tag|bool save(EntityInterface $entity, $options = [])
 * @method Tag patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Tag[] patchEntities($entities, array $data, array $options = [])
 * @method Tag findOrCreate($search, callable $callback = null)
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
     * @param Validator $validator Validator instance.
     * @return Validator
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
     * @param Query $query The query
     * @param array $options An array of options:
     *   - sfw bool, default false. Limits the result to sfw items
     *   - withAlbums bool, default true. Select the albums
     *   - withFiles bool, default true. Select the files
     *   - withNotes bool, default true. Select the notes
     *   - withPosts bool, default true. Select the posts
     *   - withProjects bool, default false. Select the projects
     *
     * @return Query
     */
    public function findWithContain(Query $query, array $options = [])
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

        // Fields
        $query->select(['id', 'album_count', 'file_count', 'note_count', 'post_count', 'project_count']);

        // Relations
        $sfw = $options['sfw'];
        $containLimit = Configure::read('cms.maxRelatedData');
        if ($options['withAlbums']) {
            $query->contain(['Albums' => function ($q) use ($sfw, $containLimit) {
                    return $q->find('withContain', ['sfw' => $sfw, 'forceOrder' => true])
                            ->limit($containLimit);
            }]);
        }
        if ($options['withFiles']) {
            $query->contain(['Files' => function ($q) use ($sfw, $containLimit) {
                    return $q->find('withContain', ['sfw' => $sfw, 'forceOrder' => true])
                            ->limit($containLimit);
            }]);
        }
        if ($options['withNotes']) {
            $query->contain(['Notes' => function ($q) use ($sfw, $containLimit) {
                    return $q->find('withContain', ['sfw' => $sfw, 'forceOrder' => true])
                            ->limit($containLimit);
            }]);
        }
        if ($options['withPosts']) {
            $query->contain(['Posts' => function ($q) use ($sfw, $containLimit) {
                    return $q->find('withContain', ['sfw' => $sfw, 'forceOrder' => true])
                            ->limit($containLimit);
            }]);
        }
        if ($options['withProjects']) {
            $query->contain(['Projects' => function ($q) use ($sfw, $containLimit) {
                    return $q->find('withContain', ['sfw' => $sfw, 'forceOrder' => true])
                            ->limit($containLimit);
            }]);
        }

        // Return the query
        return $query;
    }

    /**
     * Used to fetch minimal data about tags
     *
     * @param Query $query The query
     * @param array $options An array of options. Don't forget to add the 'pivot'
     *        field name if necessary
     *
     * @return Query
     */
    public function findAsContain(Query $query, array $options = [])
    {
        return $query->select(['id'])
                        // Define order as there may be multiple results
                        ->order(['Tags.id' => 'desc']);
    }

    /**
     * Gets a record with associated data. Throw an exception if the record is not found.
     *
     * @param mixed $primaryKey The primary key to fetch
     * @param array $options An array of options:
     *   - sfw bool, default true Limit to sfw data
     *   - complete bool default true Select all the fields
     *
     * @return Entity
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
     * @return Entity
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
                ->order('id', 'desc');
    }
}
