<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;

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
            'fields' => ['id', 'text', 'sfw', 'status', 'created', 'modified', 'user_id', 'license_id', 'language_id'],
            'contain' => [
                'Users' => ['fields' => ['id', 'username']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
            ],
            'order' => ['created' => 'desc']
        ];
        $this->set('notes', $this->paginate($this->Notes));
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
            'contain' => [
                'Users' => ['fields' => ['id', 'username']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                //, 'Tags', 'Projects']
            ]
        ]);

        $this->set('note', $note);
        $this->set('_serialize', ['note']);
    }

    /**
     * Changes a note's status.
     *
     * @param int $id Note id
     *
     * @param string $state The new state (lock, unlock or remove)
     *
     * @return void
     */
    public function changeState($id, $state = 'lock')
    {
        switch ($state) {
            case 'lock':
                $successMessage = __d('elabs', 'The note has been locked.');
                $this->Act->remove($id);
                $bit = 2;
                break;
            case 'unlock':
                $successMessage = __d('elabs', 'The note has been unlocked.');
                $bit = 1;
                break;
            case 'remove':
                $successMessage = __d('elabs', 'The note has been removed.');
                $bit = 3;
                $this->Act->remove($id, 'Projects', false);
                break;
            default:
                $successMessage = __d('elabs', 'The note has been locked.');
                $bit = 2;
        }
        $note = $this->Notes->get($id, [
            'fields' => ['id', 'status'],
            'conditions' => ['status !=' => '3'],
        ]);
        $note->status = $bit;
        if ($this->Notes->save($note)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success($successMessage);
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('elabs', 'An error occured. Please try again.'));
            }
        }
        $this->set('note', $note);
        $this->set('_serialize', ['note']);
        // Ready fo ajax calls
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'index']);
        }
    }
}
