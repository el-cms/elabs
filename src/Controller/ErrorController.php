<?php
/**
 * Error controller copied from the original one to extend AppController.
 */
namespace Cake\Controller;

use Cake\Event\Event;
use Cake\Routing\Router;

/**
 * Error Handling Controller
 *
 * Controller used by ErrorHandler to render error views.
 */
class ErrorController extends \App\Controller\AppController
{

    /**
     * Constructor
     *
     * @param \Cake\Network\Request|null $request Request instance.
     * @param \Cake\Network\Response|void $response Response instance.
     */
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);
        if (count(Router::extensions()) &&
            !isset($this->RequestHandler)
        ) {
            $this->loadComponent('RequestHandler');
        }
        $eventManager = $this->eventManager();
        if (isset($this->Auth)) {
            $eventManager->off($this->Auth);
        }
        if (isset($this->Security)) {
            $eventManager->off($this->Security);
        }
    }

    /**
     * beforeRender callback.
     *
     * @param \Cake\Event\Event $event Event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        $this->viewBuilder()->templatePath('Error');
    }
}
