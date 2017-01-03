<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

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
            'models' => ['Files', 'Posts', 'Projects', 'Notes']
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
            $data = $this->request->data;
            // Preparing data
            if (!empty($this->Auth->user('id'))) {
                $data['user_id'] = $this->Auth->user('id');
                $data['name'] = $this->Auth->user('username');
                $data['email'] = $this->Auth->user('email');
            } else {
                $data['user_id'] = null;
            }
            unset($data['body']);
            // Getting the route
            $route = Router::parse(str_replace(Router::url('/', true), '', $this->referer(true)));
            $data['fkid'] = $route['pass'][0];
            $data['model'] = $route['controller'];
            $comment = $this->Comments->patchEntity($comment, $data);
            if ($this->Comments->save($comment)) {
                if ($comment->allow_contact) {
                    $this->Flash->success(__d('elabs', 'Thank you for your comment. The author will contact you soon.'));
                } else {
                    $this->Flash->success(__d('elabs', 'Thank you for your comment.'));
                }
                $this->redirect($this->referer());
            } else {
                $this->Flash->error(__d('elabs', 'The comment could not be saved. Please try again.'));
            }
        }
        $this->redirect($this->referer());
    }
}
