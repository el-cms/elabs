<?php

namespace App\Controller\User;

use App\Controller\User\UserAppController;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 */
class NotesController extends UserAppController
{

    /**
     * Index method
     *
     * @param string $nsfw NSFW filter
     * @param string $status Status filter
     *
     * @return \Cake\Network\Response|void
     */
    public function index($nsfw = 'all', $status = 'all')
    {
        $this->paginate = [
            'fields' => ['id', 'text', 'sfw', 'status', 'created', 'modified', 'user_id', 'language_id', 'license_id'],
            'contain' => [
                'Licenses' => ['fields' => ['id', 'name']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
            ],
            'conditions' => [
                'user_id' => $this->Auth->user('id'),
                'status !=' => STATUS_DELETED
            ],
            'order' => ['created' => 'desc'],
            'sorWhiteList' => ['text', 'created', 'modified'],
        ];
        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = 1;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = 0;
        }
        if ($status === 'locked') {
            $this->paginate['conditions']['status'] = STATUS_LOCKED;
        }

        $this->set('notes', $this->paginate($this->Notes));
        $this->set('filterNSFW', $nsfw);
        $this->set('filterStatus', $status);
        $this->set('_serialize', ['notes']);
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
            // Assigning values:
            $dataSent = $this->request->data;
            $dataSent['user_id'] = $this->Auth->user('id');
            $dataSent['status'] = STATUS_PUBLISHED;
            $note = $this->Notes->patchEntity($note, $dataSent);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__d('elabs', 'The note has been saved.'));
                $this->Act->add($note->id, 'add', 'Notes', $note->created);

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('elabs', 'The note could not be saved. Please, try again.'));
                $errors = $note->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $languages = $this->Notes->Languages->find('list', ['limit' => 200]);
        $licenses = $this->Notes->Licenses->find('list', ['limit' => 200]);
//        $tags = $this->Notes->Tags->find('list', ['limit' => 200]);
//        $projects = $this->Notes->Projects->find('list', ['limit' => 200]);
        $this->set(compact('note', 'languages', 'licenses')); //, 'tags', 'projects'));
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
//            'contain' => ['Tags', 'Projects']
            'conditions' => ['user_id' => $this->Auth->user('id')],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__d('elabs', 'The note has been saved.'));
                if ($this->request->data['isMinor'] == '0') {
                    $this->Act->add($note->id, 'edit', 'Notes', $note->modified);
                }

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('elabs', 'The note could not be saved. Please, try again.'));
                $errors = $note->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $languages = $this->Notes->Languages->find('list', ['limit' => 200]);
        $licenses = $this->Notes->Licenses->find('list', ['limit' => 200]);
//        $tags = $this->Notes->Tags->find('list', ['limit' => 200]);
//        $projects = $this->Notes->Projects->find('list', ['limit' => 200]);
        $this->set(compact('note', 'languages', 'licenses')); //, 'tags', 'projects'));
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
        $note = $this->Notes->get($id, [
            'conditions' => [
                'user_id' => $this->Auth->user('id')
            ]
        ]);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__d('elabs', 'The note has been deleted.'));
//            $this->Act->remove($id);
        } else {
            $this->Flash->error(__d('elabs', 'The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
