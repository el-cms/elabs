<?php

namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

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
     * @return array
     */
    public function getPreferences(array $preferences = null)
    {
        if (is_null($preferences)) {
            $preferences = [];
        }

        return $preferences + Configure::read('cms.defaultUserPreferences');
    }
}
