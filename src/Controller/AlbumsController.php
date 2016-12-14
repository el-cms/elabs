<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Albums Controller
 *
 * @property \App\Model\Table\AlbumsTable $Albums
 */
class AlbumsController extends AppController
{

    /**
     * Index method
     *
     * @param string $filter Parameter to filter on
     * @param string $id Id of the model to filter
     *
     * @return \Cake\Network\Response|void
     */
    public function index($filter = null, $id = null)
    {
        $findOptions = [
            'fields' => [
                'id', 'name', 'description', 'created', 'modified', 'sfw', 'status', 'user_id',
            ],
            'conditions' => ['Albums.status' => 1],
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                'Projects' => ['fields' => ['id', 'name', 'ProjectsAlbums.album_id']],
                'Files' => [
                    'fields' => ['id', 'name', 'filename', 'sfw', 'AlbumsFiles.album_id'],
                    'conditions' => [
                        'status' => STATUS_PUBLISHED,
                    ],
                ],
            ],
            'order' => ['created' => 'desc'],
            'sortWhitelist' => ['created', 'name', 'modified'],
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
        $this->set('albums', $this->paginate($this->Albums));
        $this->set('_serialize', ['files']);
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
}
