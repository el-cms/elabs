<?php

namespace App\Controller\User;

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
        $notes = $this->Notes->find('users', ['uid' => $this->Auth->user('id')]);

        $this->paginate = [
            'order' => ['created' => 'desc'],
            'sorWhiteList' => ['text', 'created', 'modified'],
        ];

        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = SFW_SAFE;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = SFW_UNSAFE;
        }
        if ($status === 'locked') {
            $this->paginate['conditions']['status'] = STATUS_LOCKED;
        }

        $this->set('notes', $this->paginate($notes));
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
            // Manage tags
            $dataSent['tags']['_ids'] = $this->TagManager->merge($dataSent['tags']['_ids']);
            $note = $this->Notes->patchEntity($note, $dataSent);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__d('elabs', 'The note has been saved.'));
                if (!$note->hide_from_acts) {
                    $this->Act->add($note->id, 'add', 'Notes', $note->created);
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
        $languages = $this->Notes->Languages->find('list');
        $licenses = $this->Notes->Licenses->find('list');
        $projects = $this->Notes->Projects->find('list', ['conditions' => ['user_id' => $this->Auth->user('id')]]);
        $this->set(compact('note', 'languages', 'licenses', 'projects'));
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
            'contain' => [
                'Projects' => ['fields' => ['id', 'name', 'ProjectsNotes.note_id']],
                'Tags' => ['fields' => ['id', 'NotesTags.note_id']],
            ],
            'conditions' => ['user_id' => $this->Auth->user('id')],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Manage tags
            $this->request->data['tags']['_ids'] = $this->TagManager->merge($this->request->data['tags']['_ids']);
            $oldActState = $note->hide_from_acts;
            if ($note->status != STATUS_DELETED) {
                // Force note status
                $this->request->data['status'] = STATUS_PUBLISHED;
            } else {
                // Small dose of paranoïa
                throw new \Cake\Network\Exception\NotFoundException(__d('elabs', 'Target note not found.'));
            }
            $note = $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__d('elabs', 'The note has been saved.'));
                if ($this->request->data['isMinor'] == '0' && !$note->hide_from_acts) {
                    $this->Act->add($note->id, 'edit', 'Notes', $note->modified);
                }

                if ($oldActState === false && $note->hide_from_acts) {
                    $this->Flash->success(__d('elabs', 'The note has been removed from front page.'));
                    $this->Act->remove($note->id);
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
        $languages = $this->Notes->Languages->find('list');
        $licenses = $this->Notes->Licenses->find('list');
        $projects = $this->Notes->Projects->find('list', ['conditions' => ['user_id' => $this->Auth->user('id')]]);
        $this->set(compact('note', 'languages', 'licenses', 'projects')); //, 'tags'));
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
