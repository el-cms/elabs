<?php

namespace App\View\Helper;

use Cake\I18n\Time;

/**
 * CakePHP Helper
 * @author mtancoigne
 */
class ElabsTimeHelper extends \Cake\View\Helper\TimeHelper
{

    /**
     * Compares two dates and returns true if they are the same day.
     *
     * @param Time $date1 First date
     * @param Time $date2 Second date
     *
     * @return bool
     */
    public function isSameDay(Time $date1, Time $date2)
    {
        if ($date1->diffInDays($date2) > 0) {
            return false;
        }

        return true;
    }
}
