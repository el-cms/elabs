<?php
namespace App\Controller\User;

use App\Controller\AppController;

/**
 * Itemfiles Controller
 *
 * @property \App\Model\Table\ItemfilesTable $Itemfiles
 */
class ItemfilesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Files']
        ];
        $this->set('itemfiles', $this->paginate($this->Itemfiles));
        $this->set('_serialize', ['itemfiles']);
    }

    /**
     * View method
     *
     * @param string|null $id Itemfile id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemfile = $this->Itemfiles->get($id, [
            'contain' => ['Files']
        ]);
        $this->set('itemfile', $itemfile);
        $this->set('_serialize', ['itemfile']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemfile = $this->Itemfiles->newEntity();
        if ($this->request->is('post')) {
            $itemfile = $this->Itemfiles->patchEntity($itemfile, $this->request->data);
            if ($this->Itemfiles->save($itemfile)) {
                $this->Flash->success(__('The itemfile has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The itemfile could not be saved. Please, try again.'));
            }
        }
        $files = $this->Itemfiles->Files->find('list', ['limit' => 200]);
        $this->set(compact('itemfile', 'files'));
        $this->set('_serialize', ['itemfile']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Itemfile id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemfile = $this->Itemfiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemfile = $this->Itemfiles->patchEntity($itemfile, $this->request->data);
            if ($this->Itemfiles->save($itemfile)) {
                $this->Flash->success(__('The itemfile has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The itemfile could not be saved. Please, try again.'));
            }
        }
        $files = $this->Itemfiles->Files->find('list', ['limit' => 200]);
        $this->set(compact('itemfile', 'files'));
        $this->set('_serialize', ['itemfile']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Itemfile id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemfile = $this->Itemfiles->get($id);
        if ($this->Itemfiles->delete($itemfile)) {
            $this->Flash->success(__('The itemfile has been deleted.'));
        } else {
            $this->Flash->error(__('The itemfile could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
