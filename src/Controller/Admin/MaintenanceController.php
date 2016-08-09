<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;

/**
 * Maintenance Controller
 */
class MaintenanceController extends AdminAppController
{

    /**
     * Clears the caches
     *
     * @return void
     */
    public function clearCache()
    {
        if ($this->request->is('POST')) {
            \Cake\Cache\Cache::clearAll();
            $this->Flash->success(__d('elabs', 'The cache has been cleared'));
            $this->redirect($this->request->referer());
        } else {
            throw new \Cake\Network\Exception\MethodNotAllowedException(__d('elabs', 'Use the menu to access this functionality'));
        }
    }
}
