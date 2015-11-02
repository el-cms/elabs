<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $findOptions = [
            'fields' => [
                'id', 'title', 'excerpt', 'sfw', 'modified', 'publication_date', 'user_id', 'license_id',
            ],
            'conditions' => ['Posts.status' => 1],
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']]
            ],
            'order' => ['publication_date' => 'desc'],
            'sortWhitelist' => ['publication_date', 'title'],
        ];
        // SFW
        if (!$this->request->session()->read('see_nsfw')) {
            $findOptions['conditions']['sfw'] = true;
        }
        $this->paginate = $findOptions;
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
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']]
            ],
            'conditions' => ['Posts.status' => 1],
        ]);

        // It will be great when i'll find a way to nicely handle exceptions/errors
        if (!$post->sfw && !$this->request->session()->read('see_nsfw')) {
            // And make a proper common error page
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('post', $post);
            $this->set('_serialize', ['post']);
        }
    }
}
