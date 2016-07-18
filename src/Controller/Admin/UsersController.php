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

    /**
     * Initialize override
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     *
     * @return void
     */
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
     *
     * @return void
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        if ($this->request->is('ajax')) {
            $user = $this->Users->get($id, [
                'fields' => ['id', 'username', 'realname', 'created', 'modified', 'status', 'bio', 'post_count', 'project_count', 'file_count', 'project_user_count'],
            ]);
        } else {
            $user = $this->Users->get($id, [
                'fields' => ['id', 'username', 'realname', 'website', 'created', 'modified', 'status', 'post_count', 'project_count', 'file_count', 'project_user_count'],
                'contain' => [
                    'Posts' => [
                        'fields' => ['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id'],
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

    /**
     * Locks/unlocks an user
     *
     * @param int $id User id
     * @param string $action Action to perform : lock or unlock
     *
     * @return void
     */
    public function lock($id, $action = 'lock')
    {
        $successMessage = __d('users', 'The account has been locked.');
        $bit = 2; // Lock by default
        if ($action === 'unlock') {
            $successMessage = __d('users', 'The account has been unlocked.');
            $bit = 1;
        }
        $user = $this->Users->get($id, [
            'fields' => ['id', 'status']
        ]);
        $user->status = $bit;
        if ($this->Users->save($user)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success($successMessage);
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('users', 'An error occured'));
            }
        }
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Closes an user account
     *
     * @param int $id User id
     *
     * @return void
     */
    public function close($id)
    {
        $user = $this->Users->get($id, [
            'fields' => ['id', 'status']
        ]);
        $user->status = 3;
        if ($this->Users->save($user)) {
//            $this->Act->removeAll($id);
            if (!$this->request->is('ajax')) {
                $this->Flash->Success(__d('users', 'The account has been closed.'));
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('users', 'An error occured'));
            }
        }
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Activates an user account
     *
     * @param int $id User Id
     *
     * @return void
     */
    public function activate($id)
    {
        $user = $this->Users->get($id, [
            'fields' => ['id', 'status']
        ]);
        $user->status = 1;
        if ($this->Users->save($user)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success(__d('users', 'The account has been activated.'));
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('users', 'An error occured'));
            }
        }
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'index']);
        }
    }
}
