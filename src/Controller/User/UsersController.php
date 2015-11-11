<?php

namespace App\Controller\User;

use App\Controller\User\UserAppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends UserAppController
{
    /**
     * Edit the current user
     *
     * @return void Redirects on successful edit, renders view otherwise.
     */
    public function edit()
    {
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__d('users','Your informations are now up to date.'));
                return $this->redirect(['action' => 'edit']);
            } else {
                $this->Flash->error(__d('elabs','An error occured. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Update the password in DB
     * 
     * @return void Redirects
     */
    public function updatePassword()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Getting user data
            $user = $this->Users->get($this->Auth->user('id'));
            // Checking old password
            if ($user->comparePassword($this->request->data['current_password'])) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                // Saving new password. Validation and hashing is made in UserTable.
                if ($this->Users->save($user)) {
                    $this->Flash->success(__d('users','Your password has been updated.'));
                    return $this->redirect(['action' => 'edit']);
                } else {
                    $errors = $user->errors();
                    $errorMessages = [];
                    array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                        $errorMessages[] = $a;
                    });
                    $this->Flash->error(__d('elabs','An error occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
                    return $this->redirect(['action' => 'edit']);
                }
            } else {
                $this->Flash->error(__d('users', 'Sorry, you have entered the wrong password.'));
                return $this->redirect(['action' => 'edit']);
            }
        } else {
            $this->Flash->error(__d('users', 'To access this page, you need to fill the form first.'));
            return $this->redirect(['action' => 'edit']);
        }
    }

    /**
     * Closes account and logout
     * 
     * @return void Redirects
     */
    public function closeAccount()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->get($this->Auth->user('id'));
            if ($user->comparePassword($this->request->data['current_password'])) {
                $user->status = 3; // "deleted" state
                $this->Users->save($user);
                $this->Flash->Success(__d('users', 'Your account has been closed. If you want to re-open it, contact the administrator.'));
//                $this->Act->removeAll();
                return $this->redirect($this->Auth->logout());
            } else {
                $this->Flash->error(__d('users', 'Sorry, you have entered the wrong password.'));
                return $this->redirect(['action' => 'edit']);
            }
        } else {
            $this->Flash->error(__d('users', 'To access this page, you need to fill the form first.'));
            return $this->redirect(['action' => 'edit']);
        }
    }
}
