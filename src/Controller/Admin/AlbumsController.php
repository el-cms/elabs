<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;

/**
 * Albums Controller
 *
 * @property \App\Model\Table\AlbumsTable $Albums
 */
class AlbumsController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Languages']
        ];
        $albums = $this->paginate($this->Albums);

        $this->set(compact('albums'));
        $this->set('_serialize', ['albums']);
    }

    /**
     * View method
     *
     * @param string|null $id Album id.
     * @return \Cake\Network\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $album = $this->Albums->get($id, [
            'contain' => ['Users', 'Languages', 'Files', 'Projects']
        ]);

        $this->set('album', $album);
        $this->set('_serialize', ['album']);
    }

    /**
     * Changes an album's status.
     *
     * @param int $id Album id
     *
     * @param string $state The new state (lock, unlock or remove)
     *
     * @return void
     */
    public function changeState($id, $state = 'lock')
    {
        switch ($state) {
            case 'lock':
                $successMessage = __d('elabs', 'The album has been locked.');
                $this->Act->remove($id, 'Albums', false);
                $bit = STATUS_LOCKED;
                break;
            case 'unlock':
                $successMessage = __d('elabs', 'The album has been unlocked.');
                $bit = STATUS_PUBLISHED;
                break;
            case 'remove':
                $successMessage = __d('elabs', 'The album has been removed.');
                $bit = STATUS_DELETED;
                $this->Act->remove($id, 'Albums', false);
                break;
            default:
                $successMessage = __d('elabs', 'The album has been locked.');
                $bit = STATUS_LOCKED;
        }
        $album = $this->Albums->get($id, [
            'fields' => ['id', 'status'],
            'conditions' => ['status !=' => STATUS_DELETED],
        ]);
        $album->status = $bit;
        if ($this->Albums->save($album)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success($successMessage);
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('elabs', 'An error occured. Please try again.'));
            }
        }
        $this->set('file', $album);
        $this->set('_serialize', ['file']);
        // Ready fo ajax calls
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'index']);
        }
    }
}
