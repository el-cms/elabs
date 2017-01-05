<?php

namespace App\Controller\Admin;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AdminAppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('posts', $this->paginate($this->Posts->find('adminWithContain')));
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     *
     * @return void
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->getAdminWithContain($id);

        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }

    /**
     * Changes a post's status.
     *
     * @param int $id Post id
     * @param string $state The new state (lock, unlock or remove)
     *
     * @return void
     */
    public function changeState($id, $state = 'lock')
    {
        switch ($state) {
            case 'lock':
                $successMessage = __d('elabs', 'The post has been locked.');
                $this->Act->remove($id);
                $bit = STATUS_LOCKED;
                break;
            case 'unlock':
                $successMessage = __d('elabs', 'The post has been unlocked.');
                $bit = STATUS_PUBLISHED;
                break;
            case 'remove':
                $successMessage = __d('elabs', 'The post has been removed.');
                $bit = STATUS_DELETED;
                $this->Act->remove($id, 'Posts', false);
                break;
            default:
                $successMessage = __d('elabs', 'The post has been locked.');
                $bit = STATUS_LOCKED;
        }
        $post = $this->Posts->get($id, [
            'fields' => ['id', 'status'],
            'conditions' => ['status !=' => STATUS_DELETED],
        ]);
        $post->status = $bit;
        if ($this->Posts->save($post)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success($successMessage);
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('elabs', 'An error occured. Please try again.'));
            }
        }
        $this->set('post', $post);
        $this->set('_serialize', ['post']);
        // Ready fo ajax calls
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'index']);
        }
    }
}
