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

    /**
     * Before filter callback
     *
     * @param \Cake\Event\Event $event The beforeFilter event.
     *
     * @return void
     *
     * @throws ForbiddenException
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if (in_array($this->Auth->user('role'), ['author', 'admin'])) {
            $this->Auth->allow();
        } else {
            if (is_null($this->Auth->user('id'))) {
                $this->Flash->Error(__d('elabs', 'You should be logged in to access this page.'));
                $this->redirect($this->Auth->config('loginAction'));
            } else {
                throw new ForbiddenException(__d('elabs', 'You don\'t have enough rights to access this ressource.'));
            }
        }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     *
     * @return void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->layout('user');
    }
}
