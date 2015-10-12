<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Acts Controller
 *
 * @property \App\Model\Table\ActsTable $Acts
 */
class ActsController extends AppController {

	/**
	 * Config value, like strings and model names.
	 * Filled in initialize();
	 * @var array
	 */
	public $config = [
			'strings' => [],
			'models' => [],
	];

	/**
	 * Minimum fields to get for information tiles
	 * 
	 * @var array
	 */
	public $fields = [
//			'Files' => ['title'=>'name', 'modified'],
			'Posts' => ['title', 'modified', 'publication_date'],
			'Projects' => ['title'=>'name', 'modified', 'created'],
	];

	/**
	 * Loads additionnal models and create the configuration array
	 * 
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		// Create config strings
		$this->config = [
				'strings' => [
						'edit' => __d('elabs', 'has been updated'),
						'delete' => __d('elabs', 'has been removed'),
				],
				'models' => [
//						'Files' => __d('elabs', 'File'),
						'Posts' => __d('elabs', 'Article'),
						'Projects' => __d('elabs', 'Project'),
				]
		];

		// Load models
		foreach ($this->config['models'] as $model => $item) {
			$this->$model = TableRegistry::get($model);
		}
	}

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index() {
		// Get the list of items
		$this->paginate = [
				'contain' => ['Users'],
				'fields' => ['id', 'type', 'fkid', 'model', 'Users.id', 'Users.username'],
				'limit' => 30,
        'order' => [
            'id' => 'desc'
        ]
		];
		$acts = $this->paginate($this->Acts);

		// Get items content
		$itemsContent = [];
		foreach ($this->paginate() as $item) {
			// Get full content for new items
			if ($item['type'] === 'add') {
				$itemsContent[$item['id']] = $this->$item['model']->get($item['fkid'], ['contain' => ['Licenses']]);
			} else { // Get partial content for update/delete
				$itemsContent[$item['id']] = $this->$item['model']->get($item['fkid'], ['fields' => $this->fields[$item['model']]]);
			}
		}

		// Pass variables to view
		$this->set('acts', $acts);
		$this->set('items', $itemsContent);
		$this->set('config', $this->config);
		$this->set('_serialize', ['acts']);
	}

}
