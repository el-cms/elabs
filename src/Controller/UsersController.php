<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Before filter callback
     *
     * @param \Cake\Event\Event $event The beforeFilter event.
     * @return void
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        if (in_array($this->request->action, ['register', 'login']) && !empty($this->Auth->user('id'))) {
            throw new ForbiddenException(__d('elabs', 'You are already registered'));
        }
        if (!Configure::read('cms.isRegistrationOpen') && $this->request->action === 'register') {
            throw new ForbiddenException(__d('elabs', 'Registrations are closed for now... Come back later...'), 403);
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'sortWhiteList' => ['username', 'realname', 'created'],
            'order' => ['Users.realname' => 'asc'],
            'conditions' => [
                'OR' => [['status' => 1], ['status' => 2]]
            ],
            'sortWhitelist' => ['username', 'realname', 'created'],
            // Email should only be used for Gravatar.
            'fields' => ['id', 'username', 'realname', 'email', 'website', 'created', 'post_count', 'project_count', 'file_count', 'project_user_count']
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
        $licenseConfig = ['fields' => ['id', 'name', 'icon', 'link']];
        $options = [
            'fields' => ['id', 'username', 'realname', 'email', 'bio', 'website', 'created', 'post_count', 'project_count', 'file_count', 'project_user_count'],
            'contain' => [
                'Posts' => [
                    'fields' => ['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id', 'license_id'],
                    'conditions' => [ // SFW is made after
                        'status' => 1,
                    ],
                    'Licenses' => $licenseConfig,
                ],
                'Projects' => [
                    'fields' => ['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'user_id', 'license_id'],
                    'conditions' => [ // SFW is made after
                        'status' => 1,
                    ],
                    'Licenses' => $licenseConfig,
                ],
                'Files' => [
                    'fields' => ['id', 'name', 'description', 'filename', 'sfw', 'created', 'modified', 'user_id', 'license_id'],
                    'conditions' => [ // SFW is made after
                        'status' => 1,
                    ],
                    'Licenses' => $licenseConfig,
                ],
            ],
            'conditions' => ['OR' => [['status' => 1], ['status' => 2]]],
        ];

        // SFW options
        if ($this->request->session()->read('seeNSFW') === false) {
            $options['contain']['Posts']['conditions']['sfw'] = true;
            $options['contain']['Projects']['conditions']['sfw'] = true;
            $options['contain']['Files']['conditions']['sfw'] = true;
        }

        $user = $this->Users->get($id, $options);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Register method
     *
     * @return void (Redirection)
     */
    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            //Adding defaults
            $this->request->data['seeNSFW'] = Configure::read('cms.defaultSeeNSFW');
            $this->request->data['role'] = Configure::read('cms.defaultRole');
            $this->request->data['status'] = Configure::read('cms.defaultUserStatus');
            $this->request->data['locked'] = Configure::read('cms.defaultLockedUser');
            $this->request->data['post_count'] = 0;
            $this->request->data['project_count'] = 0;
            $this->request->data['file_count'] = 0;
            $this->request->data['project_user_count'] = 0;

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__d('elabs', 'Your account has been created. An email will be sent to you when active'));
                $this->redirect(['action' => 'index']);
            } else {
                $errors = $user->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Simple user login
     *
     * @return void (Redirection)
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->request->session()->write('seeNSFW', $this->Auth->User('seeNSFW'));
                $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__d('elabs', 'Invalid username or password, try again. Is your accound active ?'));
        }
    }

    /**
     * User logout
     *
     * @return void (redirection)
     */
    public function logout()
    {
        $this->Flash->success(__d('elabs', 'You are logged out. See you later !'));
        $this->redirect($this->Auth->logout());
    }
}
