<?php

namespace App\Controller;

use App\Model\Table\LicensesTable;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

/**
 * Licenses Controller
 *
 * @property LicensesTable $Licenses
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
        $this->paginate = [
            'sortWhiteList' => ['name', 'post_count', 'project_count', 'file_count'],
            'order' => ['name' => 'asc']
        ];
        $this->set('licenses', $this->paginate($this->Licenses));
        $this->set('_serialize', ['licenses']);
    }

    /**
     * View method
     *
     * @param string|null $id License id.
     * @return void
     * @throws NotFoundException When record not found.
     */
    public function view($id = null)
    {

        $query = $this->Licenses->getWithContain($id, ['sfw' => !$this->seeNSFW]);
        
        $this->set('license', $query);
        $this->set('_serialize', ['license']);
    }
}
