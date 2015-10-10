<?php

namespace App\Controller\User;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * User controller. All the admin controllers inherits from it.
 */
class UserAppController extends AppController {

	/**
	 * Before render callback.
	 *
	 * @param \Cake\Event\Event $event The beforeRender event.
	 * @return void
	 */
	public function beforeRender(Event $event) {
		parent::beforeRender($event);
		$this->viewBuilder()->layout('default');
	}

}
