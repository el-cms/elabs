<?php
namespace App\Controller\Admin;

use App\Controller\AdminAppController;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 */
class NotesController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Languages', 'Licenses']
        ];
        $notes = $this->paginate($this->Notes);

        $this->set(compact('notes'));
        $this->set('_serialize', ['notes']);
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Users', 'Languages', 'Licenses', 'Tags', 'Projects']
        ]);

        $this->set('note', $note);
        $this->set('_serialize', ['note']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {
            $note = $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notes->Users->find('list', ['limit' => 200]);
        $languages = $this->Notes->Languages->find('list', ['limit' => 200]);
        $licenses = $this->Notes->Licenses->find('list', ['limit' => 200]);
        $tags = $this->Notes->Tags->find('list', ['limit' => 200]);
        $projects = $this->Notes->Projects->find('list', ['limit' => 200]);
        $this->set(compact('note', 'users', 'languages', 'licenses', 'tags', 'projects'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Tags', 'Projects']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notes->Users->find('list', ['limit' => 200]);
        $languages = $this->Notes->Languages->find('list', ['limit' => 200]);
        $licenses = $this->Notes->Licenses->find('list', ['limit' => 200]);
        $tags = $this->Notes->Tags->find('list', ['limit' => 200]);
        $projects = $this->Notes->Projects->find('list', ['limit' => 200]);
        $this->set(compact('note', 'users', 'languages', 'licenses', 'tags', 'projects'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
