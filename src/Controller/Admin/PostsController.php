<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AdminAppController
{

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->helpers(['ItemsAdmin']);
        $this->viewBuilder()->helpers(['License']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'fields' => ['id', 'title', 'sfw', 'created', 'modified', 'status', 'user_id', 'license_id'],
            'contain' => [
                'Users' => ['fields' => ['id', 'username']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']]
            ]
        ];
        $this->set('posts', $this->paginate($this->Posts));
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => [
                'Users' => ['fields' => ['id', 'username']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']]
            ]
        ]);
        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }

    /**
     * Changes a post's status.
     * 
     * @param int $id
     * @param string $state The new state (lock, unlock or remove)
     * @return void
     */
    public function changeState($id, $state='lock')
    {
        switch ($state) {
            case 'lock':
                $successMessage = __d('users', 'The post has been locked.');
                $this->Act->remove($id);
                $bit = 2;
                break;
            case 'unlock':
                $successMessage = __d('users', 'The post has been unlocked.');
                // TODO: there's something to do with re-publishing things
                $bit = 1;
                break;
            case 'remove':
                $successMessage = __d('users', 'The post has been removed.');
                $bit = 3;
                $this->Act->remove($id, 'Posts', false);
                break;
            default:
                $successMessage = __d('users', 'The post has been locked.');
                $bit = 2;
        }
        $post = $this->Posts->get($id, [
            'fields' => ['id', 'status']
        ]);
        $post->status = $bit;
        if ($this->Posts->save($post)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success($successMessage);
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('users', 'An error occured'));
            }
        }
        $this->set('post', $post);
        $this->set('_serialize', ['post']);
        // Ready fo ajax calls
        // TODO : ajax action in index view
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'index']);
        }
    }
}
