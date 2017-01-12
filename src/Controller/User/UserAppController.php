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
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('TagManager');
    }

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
            $this->Auth->deny();
            if (is_null($this->Auth->user('id'))) {
                throw new ForbiddenException(__d('elabs', 'You should be logged in to access this page.'));
            } else {
                throw new ForbiddenException(__d('elabs', 'You don\'t have enough rights to access this resource.'));
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
        $this->viewBuilder()->helpers(['TagList', 'UsersUser']);
    }
}
