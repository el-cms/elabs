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
            'contain' => ['Users', 'Licenses']
        ]);
        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }
}
