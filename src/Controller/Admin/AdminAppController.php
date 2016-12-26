<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\ForbiddenException;

/**
 * Admin controller. All the admin controllers inherits from it.
 */
class AdminAppController extends AppController
{

    /**
     * Before filter callback.
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
            $this->Auth->deny();
            if (is_null($this->Auth->user('id'))) {
                throw new ForbiddenException(__d('elabs', 'You should be logged in to access this page.'));
            } else {
                throw new ForbiddenException(__d('elabs', 'You don\'t have enough rights to access this resource .'));
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
