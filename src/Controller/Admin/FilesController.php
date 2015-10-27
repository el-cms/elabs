<?php

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 */
class FilesController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('files', $this->paginate($this->Files));
        $this->set('_serialize', ['files']);
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Users', 'Itemfiles']
        ]);
        $this->set('file', $file);
        $this->set('_serialize', ['file']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEntity();
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->data);
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The file could not be saved. Please, try again.'));
            }
        }
        $users = $this->Files->Users->find('list', ['limit' => 200]);
        $this->set(compact('file', 'users'));
        $this->set('_serialize', ['file']);
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->data);
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The file could not be saved. Please, try again.'));
            }
        }
        $users = $this->Files->Users->find('list', ['limit' => 200]);
        $this->set(compact('file', 'users'));
        $this->set('_serialize', ['file']);
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
