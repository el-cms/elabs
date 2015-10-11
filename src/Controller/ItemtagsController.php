<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Itemtags Controller
 *
 * @property \App\Model\Table\ItemtagsTable $Itemtags
 */
class ItemtagsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tags']
        ];
        $this->set('itemtags', $this->paginate($this->Itemtags));
        $this->set('_serialize', ['itemtags']);
    }

    /**
     * View method
     *
     * @param string|null $id Itemtag id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemtag = $this->Itemtags->get($id, [
            'contain' => ['Tags']
        ]);
        $this->set('itemtag', $itemtag);
        $this->set('_serialize', ['itemtag']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemtag = $this->Itemtags->newEntity();
        if ($this->request->is('post')) {
            $itemtag = $this->Itemtags->patchEntity($itemtag, $this->request->data);
            if ($this->Itemtags->save($itemtag)) {
                $this->Flash->success(__('The itemtag has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The itemtag could not be saved. Please, try again.'));
            }
        }
        $tags = $this->Itemtags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('itemtag', 'tags'));
        $this->set('_serialize', ['itemtag']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Itemtag id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemtag = $this->Itemtags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemtag = $this->Itemtags->patchEntity($itemtag, $this->request->data);
            if ($this->Itemtags->save($itemtag)) {
                $this->Flash->success(__('The itemtag has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The itemtag could not be saved. Please, try again.'));
            }
        }
        $tags = $this->Itemtags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('itemtag', 'tags'));
        $this->set('_serialize', ['itemtag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Itemtag id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemtag = $this->Itemtags->get($id);
        if ($this->Itemtags->delete($itemtag)) {
            $this->Flash->success(__('The itemtag has been deleted.'));
        } else {
            $this->Flash->error(__('The itemtag could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
