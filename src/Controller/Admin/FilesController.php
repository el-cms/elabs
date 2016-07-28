<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 */
class FilesController extends AdminAppController
{

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     *
     * @return void
     */
    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->helpers(['ItemsAdmin']);
        $this->viewBuilder()->helpers(['License']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'fields' => ['id', 'name', 'filename', 'weight', 'filename', 'sfw', 'created', 'modified', 'status', 'user_id', 'license_id'],
            'contain' => [
                'Users' => ['fields' => ['id', 'username']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']]
            ],
            'order' => ['created' => 'desc']
        ];
        $this->set('files', $this->paginate($this->Files));
        $this->set('_serialize', ['files']);
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     *
     * @return void
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => [
                'Users' => ['fields' => ['id', 'username']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                'Itemfiles',
                ]
        ]);
        $this->set('file', $file);
        $this->set('_serialize', ['file']);
    }

    /**
     * Changes a file's status.
     *
     * @param int $id File id
     *
     * @param string $state The new state (lock, unlock or remove)
     *
     * @return void
     */
    public function changeState($id, $state = 'lock')
    {
        switch ($state) {
            case 'lock':
                $successMessage = __d('elabs', 'The file has been locked.');
                $this->Act->remove($id);
                $bit = 2;
                break;
            case 'unlock':
                $successMessage = __d('elabs', 'The file has been unlocked.');
                $bit = 1;
                break;
            case 'remove':
                $successMessage = __d('elabs', 'The file has been removed.');
                $bit = 3;
                $this->Act->remove($id, 'Files', false);
                break;
            default:
                $successMessage = __d('elabs', 'The file has been locked.');
                $bit = 2;
        }
        $file = $this->Files->get($id, [
            'fields' => ['id', 'status']
        ]);
        $file->status = $bit;
        if ($this->Files->save($file)) {
            if (!$this->request->is('ajax')) {
                $this->Flash->Success($successMessage);
            }
        } else {
            if (!$this->request->is('ajax')) {
                $this->Flash->Error(__d('elabs', 'An error occured'));
            }
        }
        $this->set('file', $file);
        $this->set('_serialize', ['file']);
        // Ready fo ajax calls
        if (!$this->request->is('ajax')) {
            $this->redirect(['action' => 'index']);
        }
    }
}
