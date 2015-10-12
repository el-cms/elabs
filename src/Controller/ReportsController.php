<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController {

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add() {
		$report = $this->Reports->newEntity();
		if ($this->request->is('post')) {
			$report = $this->Reports->patchEntity($report, $this->request->data);
			if ($this->Reports->save($report)) {
				$this->Flash->success(__('The report has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The report could not be saved. Please, try again.'));
			}
		}
		$this->set(compact('report'));
		$this->set('_serialize', ['report']);
	}

}
