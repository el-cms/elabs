<?php

namespace App\Controller\User;

use App\Controller\AppController;
use Cake\i18n\Time;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends UserAppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function manage()
    {
        $this->paginate = [
            'contain' => ['Users', 'Licenses']
        ];
        $this->set('posts', $this->paginate($this->Posts));
        $this->set('_serialize', ['posts']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            // Assigning values:
            $dataSent = $this->request->data;
            $dataSent['user_id'] = $this->Auth->user('id');
            if ($dataSent['published'] === '1') {
                $dataSent['publication_date'] = Time::now();
            }
            // Preparing data
            $post = $this->Posts->patchEntity($post, $dataSent);
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));
                if ($post->published) {
                    $this->Act->add($post->id, 'add', 'Posts');
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $errors = $post->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__('Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $licenses = $this->Posts->Licenses->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users', 'licenses'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->data);
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The post could not be saved. Please, try again.'));
            }
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $licenses = $this->Posts->Licenses->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users', 'licenses'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
