<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 */
class TagsController extends AppController {

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index() {
		$this->set('tags', $this->paginate($this->Tags));
		$this->set('_serialize', ['tags']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Tag id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null) {
		$tag = $this->Tags->get($id, [
				'contain' => ['Itemtags']
		]);
		$this->set('tag', $tag);
		$this->set('_serialize', ['tag']);
	}

}
