<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;

/**
 * Languages Controller
 *
 * @property \App\Model\Table\LanguagesTable $Languages
 */
class LanguagesController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|void
     */
    public function index()
    {
        $languages = $this->paginate($this->Languages);

        $this->set(compact('languages'));
        $this->set('_serialize', ['languages']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $language = $this->Languages->newEntity();
        if ($this->request->is('post')) {
            // Default counts
            $this->request->data['post_count'] = 0;
            $this->request->data['project_count'] = 0;
            $this->request->data['file_count'] = 0;
            $this->request->data['note_count'] = 0;
            $language = $this->Languages->patchEntity($language, $this->request->data);
            // Manually set the id
            $language->id = $this->request->data['id'];
            if ($this->Languages->save($language)) {
                $this->Flash->success(__d('elabs', 'The language has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('elabs', 'The language could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('language'));
        $this->set('_serialize', ['language']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Language id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $language = $this->Languages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $language = $this->Languages->patchEntity($language, $this->request->data);
            if ($this->Languages->save($language)) {
                $this->Flash->success(__d('elabs', 'The language has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('elabs', 'The language could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('language'));
        $this->set('_serialize', ['language']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Language id.
     * @ return \Cake\Network\Response|void Redirects to index.
     *
     * @return void
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        throw new \Cake\Network\Exception\NotImplementedException(__d('elabs', 'This feature needs some work...'));
//        $this->request->allowMethod(['post', 'delete']);
//        $language = $this->Languages->get($id);
//        if ($this->Languages->delete($language)) {
//            $this->Flash->success(__d('elabs', 'The language has been deleted.'));
//        } else {
//            $this->Flash->error(__d('elabs', 'The language could not be deleted. Please, try again.'));
//        }
//
//        return $this->redirect(['action' => 'index']);
    }
}
