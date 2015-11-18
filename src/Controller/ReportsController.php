<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow('add');
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $report = $this->Reports->newEntity();
        if ($this->request->is('post')) {
            // Preparing data
            if (!$this->request->data['url']) {
                $this->request->data['url'] = $this->referer();
            }
            $this->request->data['session'] = 'NULL !'; //var_export($this->Session->read(), true);
            if ($this->Auth->user('id')) {
                $this->request->data['user_id'] = $this->Auth->user('id');
                $this->request->data['name'] = $this->Auth->user('username');
                $this->request->data['email'] = $this->Auth->user('email');
            } else {
                $this->request->data['user_id'] = null;
            }
            $report = $this->Reports->patchEntity($report, $this->request->data);
            if ($this->Reports->save($report)) {
                $this->Flash->success(__d('reports', 'Thank you for your feedback'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__d('reports', 'The report could not be saved (and that should be a good reason to report it...). Please try again.'));
                return $this->redirect($this->referer());
            }
        } else {
            $this->Flash->error(__d('elabs', 'Something went wrong with your request...'));
            return $this->redirect($this->referer());
        }
    }
}
