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
    public function manage($nsfw = 'all', $published = 'all')
    {
        $this->paginate = [
            'fields' => ['id', 'title', 'sfw', 'published', 'publication_date', 'created', 'modified', 'license_id'],
            'contain' => [
                'Licenses' => ['fields' => ['id', 'name']]],
            'conditions' => ['user_id' => $this->Auth->user('id')],
            'order' => ['id' => 'desc'],
            'sortWhitelist' => ['title', 'published', 'publication_date', 'created', 'modified', 'sfw'],
        ];
        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = 1;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = 0;
        }
        if ($published === 'drafts') {
            $this->paginate['conditions']['published'] = 0;
        } elseif ($published === 'published') {
            $this->paginate['conditions']['published'] = 1;
        }
        $this->set('posts', $this->paginate($this->Posts));
        $this->set('filterNSFW', $nsfw);
        $this->set('filterPub', $published);
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
                return $this->redirect(['action' => 'manage']);
            } else {
                $errors = $post->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
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
            'conditions' => ['user_id' => $this->Auth->user('id')],
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            // Old publication state
            $oldState = $post->published;
            $this->request->data['user_id'] = $this->Auth->user('id');

            $post = $this->Posts->patchEntity($post, $this->request->data);
            if ($this->Posts->save($post)) {
                if ($oldState === false && $post->published === true) {
                    // New publication
                    $this->Act->add($post->id, 'add', 'Posts');
                    $this->Flash->success(__d('posts', 'Your article has been published.'));
                } elseif ($oldState === true && $post->published === false) {
                    // Removed from publication
                    $this->Act->remove($post->id);
                    $this->Flash->success(__d('posts', 'Your article has been unpublished.'));
                } else {
                    // Updated
                    $this->Act->add($post->id, 'edit', 'Posts');
                    $this->Flash->success(__d('posts', 'Your article has been updated.'));
                }
                return $this->redirect(['action' => 'manage']);
            } else {
                $errors = $post->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
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
     * Delete method
     *
     * @param string|null $id Post id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id, [
            'conditions' => [
                'id' => $id,
                'user_id' => $this->Auth->user('id')
            ]
        ]);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
            $this->Act->remove($id);
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'manage']);
    }
}
