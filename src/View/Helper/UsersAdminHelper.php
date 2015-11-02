<?php

namespace App\View\Helper;

use Cake\View\Helper;

class UsersAdminHelper extends Helper
{

    public function roleLabel($status, $type = 'label')
    {
        switch ($status) {
            case 'author':
                $desc = __d('users', 'Author');
                $icon = 'pencil';
                break;
            case 'admin':
                $desc = __d('users', 'Admin');
                $icon = 'wrench';
                break;
            default: // user
                $desc = __d('users', 'User');
                $icon = 'user';
                break;
        }

        switch ($type) {
            case 'icon':
                $text = __d('admin', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-' . $icon . '"></span>', $desc]);
                break;
            default: // Label
                $text = sprintf('<span class="label">%s</span>', $desc);
        }
        return $text;
    }

    public function statusLabel($status, $icon = true)
    {
        switch ($status) {
            case 0: // Waiting for approval
                $statusIcon = 'exclamation';
                $text = __d('user', 'Waiting');
                break;
            case 1: // Approved
                $statusIcon = 'check';
                $text = __d('user', 'Approved');
                break;
            case 2: // Locked
                $statusIcon = 'lock';
                $text = __d('user', 'Locked');
                break;
            case 3: // Deleted
                $statusIcon = 'times';
                $text = __d('user', 'Closed');
                break;
        }
        if ($icon) {
            return __d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-' . $statusIcon . ' fa-fw"></span>', $text]);
        } else {
            return $text;
        }
    }
}
