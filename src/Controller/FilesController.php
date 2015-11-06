<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 */
class FilesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $findOptions = [
            'fields' => [
                'id', 'name', 'filename', 'weight', 'description', 'created', 'modified', 'sfw', 'status', 'user_id', 'license_id','mime',
            ],
            'conditions' => ['Files.status' => 1],
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']]
            ],
            'order' => ['created' => 'desc'],
            'sortWhitelist' => ['created', 'name', 'modified'],
        ];
        if (!$this->request->session()->read('see_nsfw')) {
            $findOptions['conditions']['sfw'] = true;
        }
        $this->paginate = $findOptions;
        $this->set('files', $this->paginate($this->Files));
        $this->set('_serialize', ['files']);
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Users', 'Licenses', 'Itemfiles']
        ]);
        $this->set('file', $file);
        $this->set('_serialize', ['file']);
    }
}
