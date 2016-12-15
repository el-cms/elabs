<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Licenses Controller
 *
 * @property \App\Model\Table\LicensesTable $Licenses
 */
class LicensesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'sortWhiteList' => ['name', 'post_count', 'project_count', 'file_count'],
            'order' => ['name' => 'asc']
        ];
        $this->set('licenses', $this->paginate($this->Licenses));
        $this->set('_serialize', ['licenses']);
    }

    /**
     * View method
     *
     * @param string|null $id License id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $findOptions = [
            'contain' => [
                'Posts' => [
                    'Users' => ['fields' => ['id', 'username']],
                    'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    'conditions' => [ // SFW is made after
                        'Posts.status' => STATUS_PUBLISHED,
                    ],
                ],
                'Notes' => [
//                    'fields' => ['id', 'text', 'sfw', 'modified', 'created', 'user_id', 'license_id', 'language_id'],
                    'Users' => ['fields' => ['id', 'username']],
                    'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    'conditions' => [ // SFW is made after
                        'Notes.status' => STATUS_PUBLISHED,
                    ],
                ],
                'Projects' => [
                    'Users' => ['fields' => ['id', 'username']],
                    'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    'conditions' => [ // SFW is made after
                        'Projects.status' => STATUS_PUBLISHED,
                    ],
                ],
                'Files' => [
                    'Users' => ['fields' => ['id', 'username']],
                    'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    'conditions' => [ // SFW is made after
                        'Files.status' => STATUS_PUBLISHED,
                    ],
                ]
            ],
            'order' => ['name' => 'ASC']
        ];
        // SFW conditions :
        if (!$this->request->session()->read('seeNSFW')) {
            $findOptions['contain']['Files']['conditions']['Files.sfw'] = true;
            $findOptions['contain']['Notes']['conditions']['Notes.sfw'] = true;
            $findOptions['contain']['Posts']['conditions']['Posts.sfw'] = true;
            $findOptions['contain']['Projects']['conditions']['Projects.sfw'] = true;
        }
        $license = $this->Licenses->get($id, $findOptions);
        $this->set('license', $license);
        $this->set('_serialize', ['license']);
    }
}
