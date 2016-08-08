<?php

namespace App\View\Helper;

use Cake\I18n\FrozenTime;

/**
 * CakePHP Helper
 * @author mtancoigne
 */
class ElabsTimeHelper extends \Cake\View\Helper\TimeHelper
{

    /**
     * Compares two dates and returns true if they are the same day.
     *
     * @param Cake\I18n\FrozenTime $date1 First date
     * @param Cake\I18n\FrozenTime $date2 Second date
     *
     * @return bool
     */
    public function isSameDay(FrozenTime $date1, FrozenTime $date2)
    {
        if ($date1->diffInDays($date2) > 0) {
            return false;
        }

        return true;
    }
}
