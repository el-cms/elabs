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
                $desc = __d('elabs', 'Author');
                $icon = 'pencil';
                break;
            case 'admin':
                $desc = __d('elabs', 'Admin');
                $icon = 'wrench';
                break;
            default: // user
                $desc = __d('elabs', 'User');
                $icon = 'user';
                break;
        }

        switch ($type) {
            case 'icon':
                $text = $this->Html->iconT($icon, $desc);
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
            case STATUS_INACTIVE: // Waiting for approval
                $statusIcon = 'exclamation';
                $text = __d('elabs', 'Waiting');
                break;
            case STATUS_ACTIVE: // Approved
                $statusIcon = 'check';
                $text = __d('elabs', 'Approved');
                break;
            case STATUS_LOCKED: // Locked
                $statusIcon = 'lock';
                $text = __d('elabs', 'Locked');
                break;
            case STATUS_DELETED: // Deleted
                $statusIcon = 'times';
                $text = __d('elabs', 'Closed');
                break;
        }
        if ($icon) {
            return $this->Html->iconT($statusIcon, $text);
        } else {
            return $text;
        }
    }
}
