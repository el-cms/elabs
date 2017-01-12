<?php

namespace App\Controller;

use App\Model\Table\UsersTable;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    use \CakeDC\Users\Controller\Traits\LoginTrait;
    use \CakeDC\Users\Controller\Traits\RegisterTrait;

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'sortWhiteList' => ['username', 'first_name', 'last_name', 'created'],
            'order' => ['Users.username' => 'asc'],
            'sortWhitelist' => ['username', 'first_name', 'last_name', 'created'],
        ];
        $this->set('users', $this->paginate($this->Users->find('withContain')));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->getWithContain($id, ['allContain' => true, 'sfw' => !$this->seeNSFW]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }
}
