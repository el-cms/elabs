<?php

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Acts Controller
 *
 * @property \App\Model\Table\ActsTable $Acts
 */
class ActsController extends AppController
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
        $this->set('acts', $this->paginate($this->Acts));
        $this->set('_serialize', ['acts']);
    }

    /**
     * View method
     *
     * @param string|null $id Act id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $act = $this->Acts->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('act', $act);
        $this->set('_serialize', ['act']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $act = $this->Acts->newEntity();
        if ($this->request->is('post')) {
            $act = $this->Acts->patchEntity($act, $this->request->data);
            if ($this->Acts->save($act)) {
                $this->Flash->success(__('The act has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The act could not be saved. Please, try again.'));
            }
        }
        $users = $this->Acts->Users->find('list', ['limit' => 200]);
        $this->set(compact('act', 'users'));
        $this->set('_serialize', ['act']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Act id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $act = $this->Acts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $act = $this->Acts->patchEntity($act, $this->request->data);
            if ($this->Acts->save($act)) {
                $this->Flash->success(__('The act has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The act could not be saved. Please, try again.'));
            }
        }
        $users = $this->Acts->Users->find('list', ['limit' => 200]);
        $this->set(compact('act', 'users'));
        $this->set('_serialize', ['act']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Act id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $act = $this->Acts->get($id);
        if ($this->Acts->delete($act)) {
            $this->Flash->success(__('The act has been deleted.'));
        } else {
            $this->Flash->error(__('The act could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
