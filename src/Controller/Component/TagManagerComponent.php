<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * Component to handle simple tags action.
 *
 */
class TagManagerComponent extends Component
{
    /**
     * Tags table
     * @var \App\Model\Table\Tags
     */
    public $Tags = null;

    /**
     * Constructor, basically loads the Acts Model
     *
     * @param array $config Configuration array
     *
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->Tags = TableRegistry::get('Tags');
    }

    /**
     * Adds an element to the Acts table
     *
     * @param mixed $foreignKey Target foreign key
     * @param string $type Target action
     * @param string $model Target model
     * @param date $created Creation date
     *
     * @return bool
     */
    public function merge(array $tags, $model = null)
    {
        $tagList = [];
        foreach ($tags as $tag) {
            // Search for tag in db or create it
            $this->Tags->findOrCreate(['Tags.id' => $tag], function($tagEntity) use($tag){
                $tagEntity->id=$tag;

                return $tagEntity;
            });

            // Add tag to list
            $tagList[]=$tag;
        }

        return $tagList;
    }

}
