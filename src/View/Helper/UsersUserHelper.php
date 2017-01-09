<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Core\Configure;

/**
 * CakePHP UsersUserHelper
 * @author mtancoigne
 */
class UsersUserHelper extends Helper
{
    /**
     * Merges the user's preferences with the defaults
     *
     * @param array $preferences Users prefs
     *
     * @return type
     */
    public function getPreferences(array $preferences=null){
        if(is_null($preferences)){
            $preferences=[];
        }

        return $preferences + Configure::read('cms.defaultUserPreferences');
    }
}
