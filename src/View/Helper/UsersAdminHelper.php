<?php

namespace App\View\Helper;

use Cake\View\Helper;

class UsersAdminHelper extends Helper
{

    public $helpers = ['Html'];

    /**
     * Creates a label depending on a given role
     *
     * @param string $role Role to check
     * @param string $type Element type (label, icon)
     *
     * @return string
     */
    public function roleLabel($role, $type = 'label')
    {
        switch ($role) {
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
                $text = __d('admin', '{0}&nbsp;{1}', [$this->Html->icon($icon), $desc]);
                break;
            default: // Label
                $text = sprintf('<span class="label">%s</span>', $desc);
        }

        return $text;
    }

    /**
     * Creates a label depending on a given status
     *
     * @param int $status Status to check
     * @param bool $icon If true, an icon will be appended to the text.
     *
     * @return string
     */
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
            return __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon($statusIcon), $text]);
        } else {
            return $text;
        }
    }
}
