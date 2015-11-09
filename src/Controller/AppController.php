<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * List of helpers with their configuration
     * 
     * @var array
     */
    public $helpers = [
        'Tanuck/Markdown.Markdown' => ['parser' => 'GithubMarkdown'],
        'Gravatar.Gravatar'
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Act');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email'],
                    'scope' => ['status' => 1],
                ],
            ],
            'loginAction' => ['prefix' => false, 'controller' => 'Users', 'action' => 'login'],
            'authError' => __d('elabs', 'You are not allowed to view this page.'),
            'flash' => ['key' => 'flash', 'params' => ['class' => 'danger alert']],
            'loginRedirect' => ['prefix' => false, 'controller' => 'acts', 'action' => 'index'],
            'logoutRedirect' => ['prefix' => false, 'controller' => 'acts', 'action' => 'index']
        ]);
        // Elabs helper, for the entire app
        $this->viewBuilder()->helpers(['Elabs']);
    }

    /**
     * Before filter callback
     * 
     * @param Event $event
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view', 'switchSFW']);

        $this->set('see_nsfw', $this->request->session()->read('see_nsfw'));
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        // Pass some data to the view
        $authUser = null;
        if (!is_null($this->Auth->user('id'))) {
            $authUser = $this->Auth->user();
        }
        $this->set('authUser', $authUser);
    }

    /**
     * Switch the value of SFW state.
     * @param type $state
     */
    public function switchSFW($state = 'hide')
    {
        $this->request->session()->write('see_nsfw', ($state === 'show') ? true : false);
        $this->redirect($this->referer());
    }
}
