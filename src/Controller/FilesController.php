<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 */
class FilesController extends AppController {

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index() {
		$this->paginate = [
				'contain' => ['Users']
		];
		$this->set('files', $this->paginate($this->Files));
		$this->set('_serialize', ['files']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id File id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null) {
		$file = $this->Files->get($id, [
				'contain' => ['Users', 'Itemfiles']
		]);
		$this->set('file', $file);
		$this->set('_serialize', ['file']);
	}

}
