<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Admin controller. All the admin controllers inherits from it.
 */
class AdminAppController extends AppController
{
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->layout('admin');
    }
}
