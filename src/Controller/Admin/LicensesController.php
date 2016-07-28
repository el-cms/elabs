<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;

/**
 * Licenses Controller
 *
 * @property \App\Model\Table\LicensesTable $Licenses
 */
class LicensesController extends AdminAppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = ['order' => ['name' => 'asc']];
        $this->set('licenses', $this->paginate($this->Licenses));
        $this->set('_serialize', ['licenses']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $license = $this->Licenses->newEntity();
        if ($this->request->is('post')) {
            // Adding default values
            $this->request->data['post_count'] = 0;
            $this->request->data['project_count'] = 0;
            $this->request->data['file_count'] = 0;
            $license = $this->Licenses->patchEntity($license, $this->request->data);
            if ($this->Licenses->save($license)) {
                $this->Flash->success(__d('elabs', 'The license has been saved.'));
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('elabs', 'The license could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('license'));
        $this->set('_serialize', ['license']);
    }

    /**
     * Edit method
     *
     * @param string|null $id License id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $license = $this->Licenses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $license = $this->Licenses->patchEntity($license, $this->request->data);
            if ($this->Licenses->save($license)) {
                $this->Flash->success(__d('elabs', 'The license has been updated.'));
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('elabs', 'The license could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('license'));
        $this->set('_serialize', ['license']);
    }

    /**
     * Delete method
     *
     * @param string|null $id License id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $license = $this->Licenses->get($id);
        if ($this->Licenses->delete($license)) {
            $this->Flash->success(__d('elabs', 'The license has been deleted.'));
        } else {
            $this->Flash->error(__d('elabs', 'The license could not be deleted. Please, try again.'));
        }
        $this->redirect(['action' => 'index']);
    }
}
