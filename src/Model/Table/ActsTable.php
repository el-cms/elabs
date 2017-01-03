<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Acts Model
 *
 * @method \App\Model\Entity\Act get($primaryKey, $options = [])
 * @method \App\Model\Entity\Act newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Act[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Act|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Act patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Act[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Act findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ActsTable extends Table
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

        $this->table('acts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Files', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Files'],
        ]);
        $this->belongsTo('Notes', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Notes'],
        ]);
        $this->belongsTo('Posts', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Posts'],
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Projects'],
        ]);
        $this->belongsTo('Albums', [
            'foreignKey' => 'fkid',
            'conditions' => ['Acts.model' => 'Albums'],
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
                ->requirePresence('model', 'create')
                ->notEmpty('model');

        $validator
                ->uuid('fkid')
                ->requirePresence('fkid', 'create')
                ->notEmpty('fkid');

        $validator
                ->requirePresence('type', 'create')
                ->notEmpty('type');

        return $validator;
    }

    /**
     * Select All acts with their respective relations
     *
     * @param \Cake\ORM\Query $query The query
     * @param array $options An array of options :
     *   - sfw bool, default false. Limit to safe only items
     *
     * @return \Cake\ORM\Query
     */
    public function findDefault(\Cake\ORM\Query $query, array $options)
    {
        $options += [
            'sfw' => false,
        ];

        return $query->contain([
                    'Albums' => function (\Cake\ORM\Query $q) use ($options) {
                        return $q->find('withContain', ['sfw' => $options['sfw']]);
                    },
                    'Files' => function (\Cake\ORM\Query $q) use ($options) {
                        return $q->find('withContain', ['sfw' => $options['sfw']]);
                    },
                    'Notes' => function (\Cake\ORM\Query $q) use ($options) {
                        return $q->find('withContain', ['sfw' => $options['sfw']]);
                    },
                    'Posts' => function (\Cake\ORM\Query $q) use ($options) {
                        return $q->find('withContain', ['sfw' => $options['sfw']]);
                    },
                    'Projects' => function (\Cake\ORM\Query $q) use ($options) {
                        return $q->find('withContain', [
                                    'sfw' => $options['sfw'],
                                    'withAlbums' => false,
                                    'withFiles' => false,
                                    'withLanguages' => true,
                                    'withLicenses' => true,
                                    'withNotes' => false,
                                    'withPosts' => false,
                                    'withUsers' => true,
                        ]);
                    },
        ]);
    }
}
