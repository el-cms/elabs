<?php

namespace App\Controller\Admin;

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

        $this->set('notes', $this->paginate($this->Notes->find('adminWithContain')));
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
        $note = $this->Notes->getAdminWithContain($id);

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
                $bit = STATUS_LOCKED;
                break;
            case 'unlock':
                $successMessage = __d('elabs', 'The note has been unlocked.');
                $bit = STATUS_PUBLISHED;
                break;
            case 'remove':
                $successMessage = __d('elabs', 'The note has been removed.');
                $bit = STATUS_DELETED;
                $this->Act->remove($id, 'Projects', false);
                break;
            default:
                $successMessage = __d('elabs', 'The note has been locked.');
                $bit = STATUS_LOCKED;
        }
        $note = $this->Notes->get($id, [
            'fields' => ['id', 'status'],
            'conditions' => ['status !=' => STATUS_DELETED],
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
