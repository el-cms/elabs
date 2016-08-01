<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AdminAppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'fields' => ['id', 'name', 'email', 'url', 'created', 'user_id'],
            'contain' => [
                'Users' => ['fields' => ['id', 'username']],
            ],
            'order' => ['created' => 'DESC'],
        ];
        $this->set('reports', $this->paginate($this->Reports));
        $this->set('_serialize', ['reports']);
    }

    /**
     * View method
     *
     * @param string|null $id Report id.
     *
     * @return void
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $report = $this->Reports->get($id, [
            'Users' => ['fields' => ['id', 'username']],
        ]);
        $this->set('report', $report);
        $this->set('_serialize', ['report']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Report id.
     *
     * @return void (redirection)
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->Flash->success(__d('elabs', 'The report has been deleted.'));
        } else {
            $this->Flash->error(__d('elabs', 'The report could not be deleted. Please, try again.'));
        }
        $this->redirect(['action' => 'index']);
    }
}
