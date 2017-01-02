<?php

namespace App\Controller\Admin;

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
            'fields' => ['id', 'username', 'first_name', 'last_name', 'role', 'active', 'created'],
            'sortWhitelist' => ['username', 'first_name', 'last_name', 'role', 'active', 'created'],
            'order' => [
                'username' => 'asc',
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
                'fields' => ['id', 'username', 'first_name', 'last_name', 'created', 'modified', 'active', 'bio', 'post_count', 'project_count', 'file_count'],
            ]);
        } else {
            $user = $this->Users->get($id, [
                'fields' => ['id', 'username', 'first_name', 'last_name', 'website', 'created', 'modified', 'active', 'post_count', 'project_count', 'file_count'],
                'contain' => [
                    'Posts' => [
                        'fields' => ['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id'],
                        'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    ],
                    'Projects' => [
                        'fields' => ['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'user_id'],
                        'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    ],
                    'Files' => [
                        'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    ],
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
        $successMessage = __d('elabs', 'The account has been locked.');
        $bit = STATUS_LOCKED; // Lock by default
        if ($action === 'unlock') {
            $successMessage = __d('elabs', 'The account has been unlocked.');
            $bit = STATUS_ACTIVE;
        }
        $user = $this->Users->get($id, [
            'fields' => ['id', 'active'],
            'conditions' => ['active !=' => STATUS_DELETED]
        ]);
        $user->active = $bit;
        if ($this->Users->save($user)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success($successMessage);
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('elabs', 'An error occured. Please try again.'));
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
            'fields' => ['id', 'active'],
            'conditions' => ['active !=' => STATUS_DELETED]
        ]);
        $user->active = STATUS_DELETED;
        if ($this->Users->save($user)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success(__d('elabs', 'The account has been closed.'));
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('elabs', 'An error occured. Please try again.'));
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
            'fields' => ['id', 'active'],
            'conditions' => ['active' => STATUS_INACTIVE]
        ]);
        $user->active = 1;
        if ($this->Users->save($user)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success(__d('elabs', 'The account has been activated.'));
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('elabs', 'An error occured. Please try again.'));
            }
        }
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'index']);
        }
    }
}
