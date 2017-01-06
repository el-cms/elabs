<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * CakePHP TagListHelper
 * @author mtancoigne
 */
class TagListHelper extends Helper
{

    /**
     * Returns an array of ids from a list of entities
     *
     * @param array $tags The tags
     * @return array
     */
    public function tagsToList(array $tags)
    {
        $out=[];
        foreach($tags as $tag){
            $out[$tag->id]=$tag->id;
        }
        return $out;
    }
}
