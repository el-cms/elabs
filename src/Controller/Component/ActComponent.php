<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * Component to handle simple acts action.
 * 
 */
class ActComponent extends Component {

	/**
	 * Configuration array
	 */
	public $config = [
			// A list of actions and synonyms
			'actions' => [
					'update' => ['edit', 'update'],
					'add' => ['add', 'create', 'new'],
					'delete' => ['delete'],
			]
	];

	/**
	 * Additionnal components used
	 * @var array
	 */
	public $components = ['Auth'];

	/**
	 * Constructor, basically loads the Acts Model
	 * 
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);
		$this->Acts = TableRegistry::get('Acts');
		$this->Controller = $this->_registry->getController();
	}

	/**
	 * Adds an element to the Acts table
	 * 
	 * @param mixed $foreign_key Target foreign key
	 * @param string $type Target action
	 * @param string $model Target model
	 * 
	 * @return bool
	 */
	public function add($foreign_key, $type = null, $model = null) {
		// Checking params
		if (is_null($model)) {
			$model = $this->Controller->request->params['controller'];
		}
		if (is_null($type)) {
			$type = $this->Controller->request->params['action'];
		}
		$uid = $this->Auth->user('id');
		debug(['fk' => $foreign_key, 'model' => $model, 'action' => $type]);
		$act = $this->Acts->patchEntity($this->Acts->newEntity(), ['fkid' => $foreign_key, 'model' => $model, 'type' => $type, 'user_id' => $uid]);
		if ($this->Acts->save($act)) {
			return true;
		} else {
			return false;
		}
	}

}
