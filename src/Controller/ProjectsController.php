<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $findOptions = [
            'fields' => ['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'license_id', 'user_id'],
//                'Users.id', 'Users.username', 'Users.realname',
//                'Licenses.id', 'Licenses.name'],
            'conditions' => [
                'Projects.status' => 1,
            ],
            'sortWithelist' => ['created', 'modified', 'name'],
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses' => ['fields' => ['id', 'name', 'icon', 'link']]],
            'order' => ['created' => 'desc'],
        ];

        // SFW
        if (!$this->request->session()->read('seeNSFW')) {
            $findOptions['conditions']['sfw'] = true;
        }
        $this->paginate = $findOptions;
        $this->set('projects', $this->paginate($this->Projects));
        $this->set('_serialize', ['projects']);
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => [
                'Licenses',
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'ProjectUsers'],
            'conditions' => [
                'Projects.status' => 1,
            ],
        ]);

        //SFW state
        if (!$project->sfw && !$this->request->session()->read('seeNSFW')) {
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('project', $project);
            $this->set('_serialize', ['project']);
        }
    }
}
