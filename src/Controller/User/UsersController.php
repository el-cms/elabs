<?php

namespace App\Controller\User;

use App\Controller\User\UserAppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends UserAppController {

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
	 * Edit method
	 *
	 * @param string|null $id User id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit() {
		$user = $this->Users->get($this->Auth->user('id'));
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
		$this->set(compact('user'));
		$this->set('_serialize', ['user']);
	}

	public function updatePassword() {
		
	}

	public function closeAccount() {
		$user = $this->Users->get($this->Auth->user('id'), [
				'contain' => []
		]);
		if ($user->comparePassword($this->request->data['current_password'])) {
			$user->status = false;
			$user->locked = true;
			$this->Users->save($user);
			$this->Flash->Success(__d('elabs', 'Your account has been closed. If you want to re-open it, contact the administrator.'));
			return $this->redirect($this->Auth->logout());
		} else {
			$this->Flash->error(__d('elabs', 'Sorry, you have entered the wrong password.'));
			return $this->redirect(['action' => 'edit']);
		}
	}

}
