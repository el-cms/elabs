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
     * @param string $filter Filter name
     * @param mixed $id Id to filter on
     *
     * @return void
     */
    public function index($filter = null, $id = null)
    {
        $findOptions = [
            'fields' => ['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'license_id', 'user_id'],
            'conditions' => [
                'Projects.status' => 1,
            ],
            'sortWithelist' => ['created', 'modified', 'name'],
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses' => ['fields' => ['id', 'name', 'icon', 'link']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
            ],
            'order' => ['created' => 'desc'],
        ];

        // Sfw condition
        if (!$this->request->session()->read('seeNSFW')) {
            $findOptions['conditions']['sfw'] = true;
        }

        // Other conditions:
        if (!is_null($filter)) {
            switch ($filter) {
                case 'language':
                    $findOptions['conditions']['Languages.id'] = $id;
                    break;
                case 'license':
                    $findOptions['conditions']['Licenses.id'] = $id;
                    break;
                case 'user':
                    $findOptions['conditions']['Users.id'] = $id;
                    break;
                default:
                    throw new \Cake\Network\Exception\NotFoundException;
            }
            // Get additionnal infos infos
            $modelName = \Cake\Utility\Inflector::camelize(\Cake\Utility\Inflector::pluralize($filter));
            $FilterModel = \Cake\ORM\TableRegistry::get($modelName);
            $filterData = $FilterModel->get($id);

            $this->set('filterData', $filterData);
        }
        $this->set('filter', $filter);
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
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                'ProjectUsers'],
            'conditions' => [
                'Projects.status' => 1,
            ],
        ]);

        //SFW state
        if (!$project->sfw && !$this->request->session()->read('seeNSFW')) {
            $this->set('name', $project->name);
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('project', $project);
            $this->set('_serialize', ['project']);
        }
    }
}
