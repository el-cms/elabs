<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use \Cake\Network\Exception\ForbiddenException;

/**
 * Admin controller. All the admin controllers inherits from it.
 */
class AdminAppController extends AppController
{

    /**
     * Before filder callback.
     *
     * @param \Cake\Event\Event $event The beforeFilter event.
     *
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->Auth->user('role') === 'admin') {
            $this->Auth->allow();
        } else {
            if (!$this->Auth->user('id')) {
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
        $this->viewBuilder()->layout('admin');
    }
}
