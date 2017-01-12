<?php

namespace App\Controller\User;

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
        $posts = $this->Posts->find('users', ['uid' => $this->Auth->user('id')]);

        $this->paginate = [
            'order' => ['created' => 'desc'],
            'sortWhitelist' => ['title', 'status', 'publication_date', 'created', 'modified', 'sfw'],
        ];
        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = SFW_SAFE;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = SFW_UNSAFE;
        }
        if ($published === 'drafts') {
            $this->paginate['conditions']['status'] = STATUS_DRAFT;
        } elseif ($published === 'published') {
            $this->paginate['conditions']['status'] = STATUS_PUBLISHED;
        } elseif ($published === 'locked') {
            $this->paginate['conditions']['status'] = STATUS_LOCKED;
        }
        $this->set('posts', $this->paginate($posts));
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
            // Manage tags
            $dataSent['tags']['_ids'] = $this->TagManager->merge($this->request->data('tags._ids'));
            if ($dataSent['status'] == STATUS_PUBLISHED) {
                $dataSent['publication_date'] = Time::now();
            }

            // Preparing data
            $post = $this->Posts->patchEntity($post, $dataSent);
            if ($this->Posts->save($post)) {
                $this->Flash->success(__d('elabs', 'Your article has been saved.'));
                if ($post->status === STATUS_PUBLISHED && !$post->hide_from_acts) {
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
        $licenses = $this->Posts->Licenses->find('list');
        $languages = $this->Posts->Languages->find('list');
        $projects = $this->Posts->Projects->find('list', ['conditions' => ['user_id' => $this->Auth->user('id')]]);
        $this->set(compact('post', 'licenses', 'languages', 'projects', 'tags'));
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
            'contain' => [
                'Projects' => ['fields' => ['id', 'name', 'ProjectsPosts.post_id']],
                'Tags' => ['fields' => ['id', 'PostsTags.post_id']],
            ],
            'conditions' => ['user_id' => $this->Auth->user('id')],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Old publication state
            $oldState = $post->status;
            $oldActState = $post->hide_from_acts;
            if ($oldState === STATUS_DRAFT && $this->request->data['status'] == STATUS_PUBLISHED) {
                $this->request->data['publication_date'] = Time::now();
            }
            // Manage tags
            $this->request->data['tags']['_ids'] = $this->TagManager->merge($this->request->data('tags._ids'));
            $post = $this->Posts->patchEntity($post, $this->request->data);
            if ($this->Posts->save($post)) {
                if ($oldState === STATUS_DRAFT && $post->status === STATUS_PUBLISHED) {
                    // New publication
                    if (!$post->hide_from_acts) {
                        $this->Act->add($post->id, 'add', 'Posts', $post->created);
                    }
                    $this->Flash->success(__d('elabs', 'Your article has been published.'));
                } elseif ($oldState === STATUS_PUBLISHED && $post->status === STATUS_DRAFT) {
                    // Removed from publication
                    $this->Act->remove($post->id);
                    $this->Flash->success(__d('elabs', 'Your article has been unpublished.'));
                } else {
                    // Updated
                    if ($this->request->data['isMinor'] == '0' && !$post->hide_from_acts) {
                        $this->Act->add($post->id, 'edit', 'Posts', $post->modified);
                    }
                    $this->Flash->success(__d('elabs', 'Your article has been updated.'));
                }

                if ($oldActState === false && $post->hide_from_acts) {
                    $this->Flash->success(__d('elabs', 'The post has been removed from front page.'));
                    $this->Act->remove($post->id);
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
        $licenses = $this->Posts->Licenses->find('list');
        $languages = $this->Posts->Languages->find('list');
        $projects = $this->Posts->Projects->find('list', ['conditions' => ['user_id' => $this->Auth->user('id')]]);
        $this->set(compact('post', 'users', 'licenses', 'languages', 'projects', 'tags'));
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
            $this->Flash->success(__d('elabs', 'Your article has been deleted.'));
            $this->Act->remove($id);
        } else {
            $this->Flash->error(__d('elabs', 'Your article could not be deleted. Please, try again.'));
        }
        $this->redirect(['action' => 'index']);
    }
}
