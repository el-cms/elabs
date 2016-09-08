<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{
    /**
     * Config value, like strings and model names.
     * Filled in initialize();
     *
     * @var array
     */
    public $config = [
        'models' => [],
    ];

    /**
     * Loads additionnal models and create the configuration array
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        // Create config strings
        $this->config = [
            'models' => [ 'Files', 'Posts', 'Projects', 'Notes',]
        ];

        // Load models
        foreach ($this->config['models'] as $model => $item) {
            $this->$model = TableRegistry::get($model);
        }
    }

    /**
     * Before filter callback
     *
     * @param \Cake\Event\Event $event The beforeFilter event.
     * @return void
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow('add');
    }

    /**
     * Adds a comment in DB and redirects
     *
     * @return void
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        // the body field should be empty as it's a honeypot for bots
        if ($this->request->is('post') && empty($this->request->data('body'))) {
            // Getting the route
            $route = \Cake\Routing\Router::parse($this->referer());

            // Preparing data
            if (!empty($this->Auth->user('id'))) {
                $this->request->data['user_id'] = $this->Auth->user('id');
                $this->request->data['name'] = $this->Auth->user('username');
                $this->request->data['email'] = $this->Auth->user('email');
            } else {
                $this->request->data['user_id'] = null;
            }
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->save($comment)) {
                if ($comment->allow_contact) {
                    $this->Flash->success(__d('elabs', 'Thank you for your comment. The author will contact you soon.'));
                } else {
                    $this->Flash->success(__d('elabs', 'Thank you for your comment.'));
                }
                $this->redirect($this->referer());
            } else {
                $this->Flash->error(__d('elabs', 'The report could not be saved (and that should be a good reason to report it...). Please try again.'));
            }
        }
        $this->redirect($this->referer());
    }
}
