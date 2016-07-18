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
                'id', 'name', 'filename', 'weight', 'description', 'created', 'modified', 'sfw', 'status', 'user_id', 'license_id', 'mime',
            ],
            'conditions' => ['Files.status' => 1],
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']]
            ],
            'order' => ['created' => 'desc'],
            'sortWhitelist' => ['created', 'name', 'modified'],
        ];
        if (!$this->request->session()->read('seeNSFW')) {
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
        // It will be great when i'll find a way to nicely handle exceptions/errors
        if (!$file->sfw && !$this->request->session()->read('seeNSFW')) {
            // And make a proper common error page
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('file', $file);
            $this->set('_serialize', ['file']);
        }
    }

    /**
     * Forces user to download the file
     * @param int $id File id
     *
     * @return \Cake\Network\Response
     */
    public function download($id)
    {
        $file = $this->Files->get($id);
        $this->response->file('uploads/' . $file['filename'], ['download' => true, 'name' => $file['name']]);

        // Return response object to prevent controller from trying to render a view.
        return $this->response;
    }
}
