<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * CakePHP CommentCell
 * @author mtancoigne
 */
class CommentsCell extends Cell
{

    public function addForm($authUser)
    {
        $this->Comments = \Cake\ORM\TableRegistry::get('Comments');

        $this->set('model', $this->Comments->newEntity());
        $this->set('authUser', $authUser);
    }

    public function display()
    {

    }
}
