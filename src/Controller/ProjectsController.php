<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ProjectsTable;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Projects Controller
 *
 * @property ProjectsTable $Projects
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
                'Projects.status' => STATUS_PUBLISHED,
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
                    throw new NotFoundException;
            }
            // Get additionnal infos infos
            $modelName = Inflector::camelize(Inflector::pluralize($filter));
            $FilterModel = TableRegistry::get($modelName);
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
     * @throws NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $seeNSFW = $this->request->session()->read('seeNSFW');
        $containConfig = [
            'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
            'Licenses' => ['fields' => ['id', 'name', 'icon']],
            'Users' => ['fields' => ['id', 'username', 'realname']],
        ];

        $query = $this->Projects->find();
        $query->select()
                ->where(['Projects.status' => STATUS_PUBLISHED, 'Projects.id' => $id])
                ->contain([
                    'Users' => ['fields' => ['id', 'username', 'realname']],
                    'Licenses',
                    'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    'Files' => function ($q) use ($seeNSFW, $containConfig) {
                        $q = $q
                                ->where(['Files.status' => STATUS_PUBLISHED])
                                ->contain($containConfig)
                                ->limit(Configure::read('cms.maxRelatedData'));
                        if (!$seeNSFW) {
                            $q = $q->where(['sfw' => true]);
                        }

                        return $q;
                    },
                    'Notes' => function ($q) use ($seeNSFW, $containConfig) {
                        $q = $q->select()
                                ->where(['Notes.status' => STATUS_PUBLISHED])
                                ->contain($containConfig)
                                ->limit(Configure::read('cms.maxRelatedData'));
                        if (!$seeNSFW) {
                            $q = $q->where(['sfw' => true]);
                        }

                        return $q;
                    },
                    'Posts' => function ($q) use ($seeNSFW, $containConfig) {
                        $q = $q->select()
                                ->where(['Posts.status' => STATUS_PUBLISHED])
                                ->contain($containConfig)
                                ->limit(Configure::read('cms.maxRelatedData'));
                        if (!$seeNSFW) {
                            $q = $q->where(['sfw' => true]);
                        }

                        return $q;
                    },
                    'Albums' => function ($q) use ($seeNSFW, $containConfig) {
                        $q = $q->select()
                                ->where(['Albums.status' => STATUS_PUBLISHED])
                                ->contain([
                                    'Languages' => $containConfig['Languages'],
                                    'Users' => $containConfig['Users'],
                                    'Files' => [
                                        'fields' => ['id', 'name', 'filename', 'sfw', 'AlbumsFiles.album_id'],
                                    ]
                                ])
                                ->limit(Configure::read('cms.maxRelatedData'));
                        if (!$seeNSFW) {
                            $q = $q->where(['sfw' => true]);
                        }

                        return $q;
                    }
                ]);

        $project = $query->firstOrFail();

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
