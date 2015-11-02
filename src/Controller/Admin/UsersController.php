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
        $this->viewBuilder()->helpers(['UsersAdmin']);
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
        if ($this->request->is('ajax')) {
            die('ajax');
            $user = $this->Users->get($id, [
                'fields' => ['id', 'username', 'realname', 'created', 'modified', 'status', 'bio', 'post_count', 'project_count', 'file_count', 'project_user_count'],
            ]);
        } else {
            $user = $this->Users->get($id, [
                'fields' => ['id', 'username', 'realname', 'website', 'created', 'modified', 'status', 'post_count', 'project_count', 'file_count', 'project_user_count',],
                'contain' => [
                    'Posts' => [
                        'fields' => ['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id'],
//                        'conditions' => [
//                            'published' => true,
//                        ],
                    ],
                    'Projects' => [
                        'fields' => ['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'user_id'],
                    ],
                    'Files' => [],
                ],
            ]);
        }
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
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'view', $id]);
        }
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
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'view', $id]);
        }
    }

    public function activate($id)
    {
        $user = $this->Users->get($id, [
            'fields' => ['id', 'status']
        ]);
        $user->status = 1;
        $this->Users->save($user);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'view', $id]);
        }
    }
}
