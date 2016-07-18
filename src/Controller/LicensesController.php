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
                    'Users' => ['fields' => ['id', 'username']]
                ],
                'Projects' => [
                    'Users' => ['fields' => ['id', 'username']]
                ],
                'Files' => [
                    'Users' => ['fields' => ['id', 'username']]
                ]
            ]
        ];
        // SFW conditions :
        if (!$this->request->session()->read('seeNSFW')) {
            $findOptions['contain']['Posts']['conditions']['Posts.sfw'] = true;
            $findOptions['contain']['Projects']['conditions']['Projects.sfw'] = true;
            $findOptions['contain']['Files']['conditions']['Files.sfw'] = true;
        }
        $license = $this->Licenses->get($id, $findOptions);
        $this->set('license', $license);
        $this->set('_serialize', ['license']);
    }
}
