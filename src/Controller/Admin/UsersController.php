<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AdminAppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->helpers(['UserAdmin']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'fields' => ['id', 'username', 'realname', 'role', 'status', 'created'],
            'sortWhitelist' => ['username', 'realname', 'role', 'status', 'created'],
            'order' => [
                'status' => 'asc',
            ]
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'fields' => ['id', 'username', 'realname', 'created', 'modified', 'status', 'bio'],
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function lock($id, $action = 'lock')
    {
        $bit = 2; // Lock by default
        if ($action === 'unlock') {
            $bit = 1;
        }
        $user = $this->Users->get($id, [
            'fields' => ['id', 'status']
        ]);
        $user->status = $bit;
        $this->Users->save($user);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function close($id)
    {
        $user = $this->Users->get($id, [
            'fields' => ['id', 'status']
        ]);
        $user->status = 3;
        $this->Users->save($user);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }
}
