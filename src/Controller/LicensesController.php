<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Licenses Controller
 *
 * @property \App\Model\Table\LicensesTable $Licenses
 */
class LicensesController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('licenses', $this->paginate($this->Licenses));
        $this->set('_serialize', ['licenses']);
    }

    /**
     * View method
     *
     * @param string|null $id License id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $license = $this->Licenses->get($id, [
            'contain' => ['Posts', 'Projects']
        ]);
        $this->set('license', $license);
        $this->set('_serialize', ['license']);
    }
}
