<?php

namespace App\Controller;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{

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

         $this->Security->config('unlockedActions', ['add']);
    }

    /**
     * Adds a report in DB and redirects
     *
     * @return void
     */
    public function add()
    {
        $report = $this->Reports->newEntity();
        if ($this->request->is('post') && empty($this->request->data('body'))) {
            // Preparing data
            if (empty($this->request->data['url'])) {
                $this->request->data['url'] = $this->referer();
            }
            $this->request->data['session'] = 'NULL !'; //var_export($this->Session->read(), true);
            if (!empty($this->Auth->user('id'))) {
                $this->request->data['user_id'] = $this->Auth->user('id');
                $this->request->data['name'] = $this->Auth->user('username');
                $this->request->data['email'] = $this->Auth->user('email');
            } else {
                $this->request->data['user_id'] = null;
            }
            $report = $this->Reports->patchEntity($report, $this->request->data);
            if ($this->Reports->save($report)) {
                $this->Flash->success(__d('elabs', 'Thank you for your feedback'));

                $this->redirect($this->referer());
            } else {
                $this->Flash->error(__d('elabs', 'The report could not be saved (and that should be a good reason to report it...). Please try again.'));
            }
        }
//        else {
//            $this->Flash->error(__d('elabs', 'Something went wrong with your request...'));
//        }
        $this->redirect($this->referer());
    }
}
