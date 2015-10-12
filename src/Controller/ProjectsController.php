<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController {

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index() {
		$this->paginate = [
				'contain' => ['Licenses', 'Users']
		];
		$this->set('projects', $this->paginate($this->Projects));
		$this->set('_serialize', ['projects']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Project id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null) {
		$project = $this->Projects->get($id, [
				'contain' => ['Licenses', 'Users', 'ProjectUsers']
		]);
		$this->set('project', $project);
		$this->set('_serialize', ['project']);
	}

}
