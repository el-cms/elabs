<?php

namespace App\Controller\User;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\ForbiddenException;

/**
 * User controller. All the admin controllers inherits from it.
 */
class UserAppController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if (in_array($this->Auth->user('role'), ['user', 'admin'])) {
            $this->Auth->allow();
        } else {
            throw new ForbiddenException(__d('elabs', 'You don\'t have enough rights to access this ressource.'));
        }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->layout('user');
    }
}
