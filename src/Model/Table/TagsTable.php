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
     *   - allStatuses bool, default true. Overrides status limitation
     *   - sfw bool, default false. Limits the result to sfw items
     *   - uid string, default null. Select only items for this user
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
//            'allStatuses' => false,
//            'complete' => false,
//            'sfw' => true,
//            'uid' => null,
            'withProjects' => true,
            'withUsers' => true,
        ];

        $where = [];

        // Conditions
//        if ($options['allStatuses'] === false) {
//            $where = ['Posts.status' => STATUS_PUBLISHED];
//        }
//        if ($options['sfw'] === true) {
//            $where['Posts.sfw'] = true;
//        }
//        if (!is_null($options['uid'])) {
//            $where['Posts.user_id'] = $options['uid'];
//        }

        // Fields
        $query->select(['id'])
                ->where($where);
//        if ($options['complete'] === true) {
//            $query->select(['text']);
//        }

        // Relations
        if ($options['withAlbums']) {
            $query->contain(['Albums' => function ($q) {
                    return $q->find('asContain', ['pivot' => 'AlbumsTags.tag_id']);
            }]);
        }
        if ($options['withFiles']) {
            $query->contain(['Files' => function ($q) {
                    return $q->find('asContain', ['pivot' => 'FilesTags.tag_id']);
            }]);
        }
        if ($options['withNotes']) {
            $query->contain(['Notes' => function ($q) {
                    return $q->find('asContain', ['pivot' => 'NotesTags.tag_id']);
            }]);
        }
        if ($options['withPosts']) {
            $query->contain(['Posts' => function ($q) {
                    return $q->find('asContain', ['pivot' => 'PostsTags.tag_id']);
            }]);
        }
        if ($options['withProjects']) {
            $query->contain(['Projects' => function ($q) {
                    return $q->find('asContain', ['pivot' => 'ProjectsTags.tag_id']);
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
}
