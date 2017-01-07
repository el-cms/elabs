<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AlbumsTags Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Albums
 * @property \Cake\ORM\Association\BelongsTo $Tags
 *
 * @method \App\Model\Entity\AlbumsTag get($primaryKey, $options = [])
 * @method \App\Model\Entity\AlbumsTag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AlbumsTag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AlbumsTag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AlbumsTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AlbumsTag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AlbumsTag findOrCreate($search, callable $callback = null)
 */
class AlbumsTagsTable extends Table
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

        $this->table('albums_tags');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('CounterCache', [
            'Tags' => ['album_count' => ['conditions' => ['Albums.status' => STATUS_PUBLISHED]]],
        ]);

        $this->belongsTo('Albums', [
            'foreignKey' => 'album_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tags', [
            'foreignKey' => 'tag_id',
            'joinType' => 'INNER'
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
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['album_id'], 'Albums'));
        $rules->add($rules->existsIn(['tag_id'], 'Tags'));

        return $rules;
    }
}
