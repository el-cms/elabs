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
     * Creates tags if they don't exist and return the request data
     *
     * @param array $tags
     * @return array
     */
    public function merge(array $tags = null)
    {
        $tagList = [];
        if (!is_null($tags)) {
            foreach ($tags as $tag) {
                // Search for tag in db or create it
                $this->Tags->findOrCreate(['Tags.id' => $tag], function($tagEntity) use($tag) {
                    $tagEntity->id = $tag;

                    return $tagEntity;
                });

                // Add tag to list
                $tagList[] = $tag;
            }
        }

        return $tagList;
    }
}
