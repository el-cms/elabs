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
                $this->updateAuthUser($user);
                $this->Flash->success(__d('elabs', 'Your informations are now up to date.'));
                $this->redirect(['action' => 'edit']);
            } else {
                $this->Flash->error(__d('elabs', 'An error occured. Please try again.'));
            }
        }
        $this->Languages = \Cake\ORM\TableRegistry::get('Languages');
        $sLanguages = $this->Languages->find('list', ['fields' => ['id' => 'translation_folder', 'name'], 'conditions' => ['has_site_translation' => true]]);
        $wLanguages = $this->Languages->find('list');
        $this->Licenses = \Cake\ORM\TableRegistry::get('Licenses');
        $licenses = $this->Licenses->find('list');
        $this->set(compact('user', 'wLanguages', 'sLanguages', 'licenses'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Updates user preferences
     *
     * @return void Redirects on successful edit
     */
    public function updatePrefs()
    {
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Preparing data. Keys from site defaults will be used to avoid wrong keys.
            $defaults = \Cake\Core\Configure::read('cms.defaultUserPreferences');
            $userPrefs = [];
            foreach ($defaults as $k => $v) {
                $userPrefs[$k] = $this->request->data['preferences'][$k];
            }
            $user = $this->Users->patchEntity($user, ['preferences' => json_encode($userPrefs)]);
            if ($this->Users->save($user)) {
                $this->updateAuthUser($user);
                $this->Flash->success(__d('elabs', 'Your preferences have been updated.'));
                $this->redirect(['action' => 'edit']);
            } else {
                $this->Flash->error(__d('elabs', 'An error occured. Please try again.'));
            }
        } else {
            die('nope');
        }
    }

    /**
     * Update the session of an user with new values
     *
     * @param \App\Model\Entity\User $user Updated user data
     *
     * @return void
     */
    protected function updateAuthUser(\App\Model\Entity\User $user)
    {
        $this->Auth->setUser([
            'id' => $user->id,
            'email' => $user->email,
            'username' => $user->username,
            'realname' => $user->realname,
            'website' => $user->website,
            'bio' => $user->bio,
            'created' => $user->created,
            'modified' => $user->modified,
            'role' => $user->role,
            'status' => $user->status,
            'file_count' => $user->file_count,
            'note_count' => $user->note_count,
            'post_count' => $user->post_count,
            'project_count' => $user->project_count,
            'preferences' => $user->preferences
        ]);
        $this->_setUserPreferences($user->preferences);
    }

    /**
     * Update the password in DB
     *
     * @return void Redirects
     */
    public function updatePassword()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userId = $this->Auth->user('id');
            $dataSent = $this->request->data();
            // Getting user data
            $user = $this->Users->get($userId);
            // Force id
            $dataSent['id'] = $userId;
            // Checking old password
            if ($user->comparePassword($dataSent['current_password'])) {
                $user = $this->Users->patchEntity($user, $dataSent);
                // Saving new password. Validation and hashing is made in UserTable.
                if ($this->Users->save($user)) {
                    $this->Flash->success(__d('elabs', 'Your password has been updated.'));
                    $this->redirect(['action' => 'edit']);
                } else {
                    $errors = $user->errors();
                    $errorMessages = [];
                    array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                        $errorMessages[] = $a;
                    });
                    $this->Flash->error(__d('elabs', 'An error occured. Please try again.'), ['params' => ['errors' => $errorMessages]]);
                    $this->redirect(['action' => 'edit']);
                }
            } else {
                $this->Flash->error(__d('elabs', 'Sorry, you have entered the wrong password.'));
                $this->redirect(['action' => 'edit']);
            }
        } else {
            $this->Flash->error(__d('elabs', 'To access this page, you need to fill the form first.'));
            $this->redirect(['action' => 'edit']);
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
                $this->Flash->Success(__d('elabs', 'Your account has been closed. If you want to re-open it, contact the administrator.'));
//                $this->Act->removeAll();
                $this->redirect($this->Auth->logout());
            } else {
                $this->Flash->error(__d('elabs', 'Sorry, you have entered the wrong password.'));
                $this->redirect(['action' => 'edit']);
            }
        } else {
            $this->Flash->error(__d('elabs', 'To access this page, you need to fill the form first.'));
            $this->redirect(['action' => 'edit']);
        }
    }
}
