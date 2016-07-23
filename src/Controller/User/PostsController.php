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
     * @param string $nsfw NSFW filter
     * @param string $published Publication state filter
     *
     * @return void
     */
    public function index($nsfw = 'all', $published = 'all')
    {
        $this->paginate = [
            'fields' => ['id', 'title', 'excerpt', 'sfw', 'status', 'publication_date', 'created', 'modified', 'license_id'],
            'contain' => [
                'Licenses' => ['fields' => ['id', 'name']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']]
            ],
            'conditions' => ['user_id' => $this->Auth->user('id')],
            'order' => ['created' => 'desc'],
            'sortWhitelist' => ['title', 'status', 'publication_date', 'created', 'modified', 'sfw'],
        ];
        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = 1;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = 0;
        }
        if ($published === 'drafts') {
            $this->paginate['conditions']['status'] = 0;
        } elseif ($published === 'published') {
            $this->paginate['conditions']['status'] = 1;
        } elseif ($published === 'locked') {
            $this->paginate['conditions']['status'] = 2;
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
            if ($dataSent['status'] === '1') {
                $dataSent['publication_date'] = Time::now();
            }

            // Preparing data
            $post = $this->Posts->patchEntity($post, $dataSent);
            if ($this->Posts->save($post)) {
                $this->Flash->success(__d('posts', 'Your article has been saved.'));
                if ($post->status === 1) {
                    $this->Act->add($post->id, 'add', 'Posts', $post->created);
                }
                $this->redirect(['action' => 'index']);
            } else {
                $errors = $post->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $licenses = $this->Posts->Licenses->find('list', ['limit' => 200]);
        $languages = $this->Posts->Languages->find('list', ['limit' => 200]);
        $this->set(compact('post', 'licenses', 'languages'));
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
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Old publication state
            $oldState = $post->status;
            if ($oldState === 0 && $this->request->data['status'] === '1') {
                $this->request->data['publication_date'] = Time::now();
            }
            $post = $this->Posts->patchEntity($post, $this->request->data);
            if ($this->Posts->save($post)) {
                if ($oldState === 0 && $post->status === 1) {
                    // New publication
                    $this->Act->add($post->id, 'add', 'Posts', $post->created);
                    $this->Flash->success(__d('posts', 'Your article has been published.'));
                } elseif ($oldState === 1 && $post->status === 0) {
                    // Removed from publication
                    $this->Act->remove($post->id);
                    $this->Flash->success(__d('posts', 'Your article has been unpublished.'));
                } else {
                    // Updated
                    if ($this->request->data['isMinor'] == '0') {
                        $this->Act->add($post->id, 'edit', 'Posts', $post->modified);
                    }
                    $this->Flash->success(__d('posts', 'Your article has been updated.'));
                }
                $this->redirect(['action' => 'index']);
            } else {
                $errors = $post->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $licenses = $this->Posts->Licenses->find('list', ['limit' => 200]);
        $languages = $this->Posts->Languages->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users', 'licenses', 'languages'));
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
                'user_id' => $this->Auth->user('id')
            ]
        ]);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__d('posts', 'Your article has been deleted.'));
            $this->Act->remove($id);
        } else {
            $this->Flash->error(__d('posts', 'Your article could not be deleted. Please, try again.'));
        }
        $this->redirect(['action' => 'index']);
    }
}
