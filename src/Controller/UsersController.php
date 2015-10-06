<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

	public function beforeFilter(\Cake\Event\Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['register', 'logout']);
	}

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index() {
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
	public function view($id = null) {
		$user = $this->Users->get($id, [
				'contain' => ['Events', 'Posts', 'Projects']
		]);
		$this->set('user', $user);
		$this->set('_serialize', ['user']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function register() {
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {

			//Adding defaults
			$this->request->data['see_nsfw'] = Configure::read('cms.defaultSeeNSFW');
			$this->request->data['role'] = Configure::read('cms.defaultRole');
			$this->request->data['status'] = Configure::read('cms.defaultActivateUser');
			$this->request->data['locked'] = Configure::read('cms.defaultLockedUser');

			$user = $this->Users->patchEntity($user, $this->request->data);
//			die('<pre>' . var_export($user, true) . '</pre>');
			if ($this->Users->save($user)) {
				$this->Flash->success(__d('elabs', 'Your account has been created. An email will be sent to you when active'));
				return $this->redirect(['action' => 'index']);
			} else {
				$errors=$user->errors();
				$errorMessages=[];
				array_walk_recursive($errors, function($a) use (&$errorMessages) { $errorMessages[] = $a; });
//				die('<pre>' . var_export($errorMessages, true) . '</pre>');
				$this->Flash->error(__('Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
			}
		}
		$this->set(compact('user'));
		$this->set('_serialize', ['user']);
	}

	public function login() {
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

}
