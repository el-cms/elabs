<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController {

	public $helpers = [
			'Tanuck/Markdown.Markdown' => ['parser' => 'GithubMarkdown']
	];

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index() {
		$this->paginate = [
				'contain' => ['Users', 'Licenses']
		];
		$this->set('posts', $this->paginate($this->Posts));
		$this->set('_serialize', ['posts']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Post id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null) {
		$post = $this->Posts->get($id, [
				'contain' => ['Users', 'Licenses']
		]);
		$this->set('post', $post);
		$this->set('_serialize', ['post']);
	}

}
